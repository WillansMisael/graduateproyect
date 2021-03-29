<?php

use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware(['auth'])->group( function() {
    Route::get('/dash', 'App\Http\Controllers\DashController@data')->middleware('permission:reportes_graficos');
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::view('instituciones','instituciones')->middleware('permission:instituciones_inicio');
    Route::view('medicos', 'medicos')->middleware('permission:medicos_inicio');
    Route::view('pacientes', 'pacientes')->middleware('permission:pacientes_inicio');
    Route::view('personal','personal')->middleware('permission:personal_inicio');
    Route::view('usuarios','usuarios')->middleware('permission:usuarios_inicio');
    Route::view('unidades','unidades')->middleware('permission:unidades_inicio');
    Route::view('familias', 'familias')->middleware('permission:familias_inicio');
    Route::view('grupos','grupos')->middleware('permission:grupos_inicio');
    Route::view('examenes','examenes')->middleware('permission:examenes_inicio');
    Route::view('subgrupoexamenes','subgrupoexamenes')->middleware('permission:subgrupoexamenes_inicio');
    Route::view('valoresexamenes','valoresexamenes')->middleware('permission:valoresexamenes_inicio');
    Route::view('examenescompletos','examenescompletos')->middleware('permission:examenescompletos_inicio');
    Route::view('resultados','resultados')->middleware('permission:solicitudes_inicio');
    Route::view('citasadmin','citasadmin')->middleware('permission:citas_inicio');
    Route::resource('citas', App\Http\Controllers\CitasController::class)->middleware('permission:reservar_citas_inicio');
    
    Route::view('solicitudesdiarias','solicitudesdiarias')->middleware('permission:reporte_solicitudes_diarias');
    Route::view('solicitudesporfechas','solicitudesporfechas')->middleware('permission:reporte_solicitudes_por_fechas');
    Route::view('solicitudesporpacientes','solicitudesporpacientes')->middleware('permission:reporte_solicitudes_por_paciente');
    Route::view('reporteporexamenes','reporteporexamenes')->middleware('permission:reporte_por_examenes');
    Route::view('vistadatosmedico','vistadatosmedico')->middleware('permission:vista_medicos');
    Route::view('vistadatospaciente','vistadatospaciente')->middleware('permission:vista_pacientes');
    Route::view('permisos','permisos')->middleware('permission:roles_permisos');//agregar middleware cuando este todo lleno
    

    Route::resource('solicitud', App\Http\Controllers\SolicitudController::class)->names('solicitud');
    
    
    Route::get('backups', 'App\Http\Controllers\BackupController@index');
    Route::get('backup/create', 'App\Http\Controllers\BackupController@create');
    Route::get('backup/download/{file_name}', 'App\Http\Controllers\BackupController@download');
    Route::get('backup/delete/{file_name}', 'App\Http\Controllers\BackupController@delete');
});
