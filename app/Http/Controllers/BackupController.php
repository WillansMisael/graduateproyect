<?php
namespace App\Http\Controllers;

use Alert;
use Artisan;
use Carbon\Carbon;
use Log;
use Spatie\Backup\Helpers\Format;
use Storage;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:backup_inicio')->only(['index']);
        $this->middleware('can:backup_crear')->only(['create','store']);
        $this->middleware('can:backup_editar')->only(['edit','update']);
        $this->middleware('can:backup_eliminar')->only(['destroy']);
    }

    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];

        foreach ($files as $k => $f) {

            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => Format::humanReadableSize($disk->size($f)),
                    'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f)),
                ];
            }
        }

        $backups = array_reverse($backups);
        return view("admin.backups.backups")->with(compact('backups'));
    }
    public function create()
    {
        try {
        
            Artisan::call('backup:run', ['--only-db' => 'true']);
            $output = Artisan::output();
       
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            
            \Session::flash('flash_message','La copia de seguridad fue realizada con éxito');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            \Session::flash('flash_message','La copia de seguridad eliminada realizada con éxito');
            
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
}