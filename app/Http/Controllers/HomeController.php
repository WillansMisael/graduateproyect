<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Personal;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        //traemos los datos de user
        $datauser = auth()->user();
        //traermos los roles que tiene
        $roles = $datauser->getRoleNames();
        
        //recuperamos el id del user
        $id = auth()->user()->id;
        // verificamos el rol para traer sus datos personales
        if ($datauser->hasanyRole(['Admin', 'Personal'])){
            $data = Personal::where('user','=',$id)->firstOrFail();
        }
        if ($datauser->hasRole('Paciente')) {
            $data = Paciente::where('user','=',$id)->firstOrFail();
        }
        if ($datauser->hasRole('Medico')) {
            $data = Medico::where('user','=',$id)->firstOrFail();
        }
        return view('home', ['rol'=>$roles,
                            'data'=>$data,
        ]);
    }
}
