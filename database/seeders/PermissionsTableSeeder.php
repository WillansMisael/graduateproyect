<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Personal;
use App\Models\Unidad;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creación de usuarios
        
        User::create([
            'email' => 'admin@personal',
            'password' => bcrypt('admin')
        ]);

        Personal::create([
            'name' => 'Administrador',
            'last_name' => 'Sistema',
            'cargo' => 'Administrador',
            'nro_ci' => '00000000',
            'date_nac' => '1990-12-12',
            'direction' => 's/d',
            'cel' => '00000000',
            'user' => User::find(1)->id
        ]);

        //lista de permisos iniciales - debe ir permisos para todos los compoenentes
        Permission::create(['name'=>'instituciones_inicio']);
        Permission::create(['name'=>'instituciones_crear']);
        Permission::create(['name'=>'instituciones_editar']);
        Permission::create(['name'=>'instituciones_eliminar']);

        Permission::create(['name'=>'medicos_inicio']);
        Permission::create(['name'=>'medicos_crear']);
        Permission::create(['name'=>'medicos_editar']);
        Permission::create(['name'=>'medicos_eliminar']);

        Permission::create(['name'=>'pacientes_inicio']);
        Permission::create(['name'=>'pacientes_crear']);
        Permission::create(['name'=>'pacientes_editar']);
        Permission::create(['name'=>'pacientes_eliminar']);

        Permission::create(['name'=>'personal_inicio']);
        Permission::create(['name'=>'personal_crear']);
        Permission::create(['name'=>'personal_editar']);
        Permission::create(['name'=>'personal_eliminar']);

        Permission::create(['name'=>'usuarios_inicio']);
        Permission::create(['name'=>'usuarios_crear']);
        Permission::create(['name'=>'usuarios_editar']);
        Permission::create(['name'=>'usuarios_eliminar']);

        Permission::create(['name'=>'unidades_inicio']);
        Permission::create(['name'=>'unidades_crear']);
        Permission::create(['name'=>'unidades_editar']);
        Permission::create(['name'=>'unidades_eliminar']);

        Permission::create(['name'=>'familias_inicio']);
        Permission::create(['name'=>'familias_crear']);
        Permission::create(['name'=>'familias_editar']);
        Permission::create(['name'=>'familias_eliminar']);

        Permission::create(['name'=>'grupos_inicio']);
        Permission::create(['name'=>'grupos_crear']);
        Permission::create(['name'=>'grupos_editar']);
        Permission::create(['name'=>'grupos_eliminar']);

        Permission::create(['name'=>'examenes_inicio']);
        Permission::create(['name'=>'examenes_crear']);
        Permission::create(['name'=>'examenes_editar']);
        Permission::create(['name'=>'examenes_eliminar']);

        Permission::create(['name'=>'subgrupoexamenes_inicio']);
        Permission::create(['name'=>'subgrupoexamenes_crear']);
        Permission::create(['name'=>'subgrupoexamenes_editar']);
        Permission::create(['name'=>'subgrupoexamenes_eliminar']);
        
        Permission::create(['name'=>'valoresexamenes_inicio']);
        Permission::create(['name'=>'valoresexamenes_crear']);
        Permission::create(['name'=>'valoresexamenes_editar']);
        Permission::create(['name'=>'valoresexamenes_eliminar']);

        Permission::create(['name'=>'examenescompletos_inicio']);

        Permission::create(['name'=>'solicitudes_inicio']);
        Permission::create(['name'=>'solicitudes_crear']);

        Permission::create(['name'=>'llenado_resultados']);

        Permission::create(['name'=>'imprimir_proforma']);

        Permission::create(['name'=>'saldar_cuenta_solicitud']);
        
        Permission::create(['name'=>'confirmar_citas']);
        
        Permission::create(['name'=>'reservar_citas_inicio']);
        
        Permission::create(['name'=>'citas_inicio']);
        Permission::create(['name'=>'citas_crear']);
        Permission::create(['name'=>'citas_editar']);
        Permission::create(['name'=>'citas_eliminar']);

        Permission::create(['name'=>'reportes']);
        Permission::create(['name'=>'reporte_solicitudes_diarias']);
        Permission::create(['name'=>'reporte_solicitudes_por_fechas']);
        Permission::create(['name'=>'reporte_solicitudes_por_paciente']);
        Permission::create(['name'=>'reporte_por_examenes']);
        Permission::create(['name'=>'reportes_graficos']);

        Permission::create(['name'=>'vista_medicos']);
        Permission::create(['name'=>'vista_pacientes']);

        Permission::create(['name'=>'roles_permisos']);

        Permission::create(['name'=>'backup_inicio']);
        Permission::create(['name'=>'backup_crear']);
        Permission::create(['name'=>'backup_descargar']);
        Permission::create(['name'=>'backup_eliminar']);

        Permission::create(['name'=>'menu_inicio']);
        Permission::create(['name'=>'menu_solicitudes']);
        Permission::create(['name'=>'menu_examenes']);
        Permission::create(['name'=>'menu_reportes']);
        Permission::create(['name'=>'menu_usuarios']);
        Permission::create(['name'=>'menu_accesos']);
        Permission::create(['name'=>'menu_respaldos']);
        
        //lista de roles
        $admin = Role::create(['name'=>'Administrador']);
        $paciente = Role::create(['name'=>'Paciente']);
        $medico = Role::create(['name'=>'Medico']);
        $personal = Role::create(['name'=>'Personal']);
        $laboratorista = Role::create(['name'=>'Laboratorista']);
        $secretaria = Role::create(['name'=>'Secretaria']);

        //Dar permisos a un rol
        $admin->givePermissionTo([
            'instituciones_inicio',
            'instituciones_crear',
            'instituciones_editar',
            'instituciones_eliminar',
            'medicos_inicio',
            'medicos_crear',
            'medicos_editar',
            'medicos_eliminar',
            'pacientes_inicio',
            'pacientes_crear',
            'pacientes_editar',
            'pacientes_eliminar',
            'personal_inicio',
            'personal_crear',
            'personal_editar',
            'personal_eliminar',
            'usuarios_inicio',
            'usuarios_crear',
            'usuarios_editar',
            'usuarios_eliminar',
            'unidades_inicio',
            'unidades_crear',
            'unidades_editar',
            'unidades_eliminar',
            'familias_inicio',
            'familias_crear',
            'familias_editar',
            'familias_eliminar',
            'grupos_inicio',
            'grupos_crear',
            'grupos_editar',
            'grupos_eliminar',
            'examenes_inicio',
            'examenes_crear',
            'examenes_editar',
            'examenes_eliminar',
            'subgrupoexamenes_inicio',
            'subgrupoexamenes_crear',
            'subgrupoexamenes_editar',
            'subgrupoexamenes_eliminar',
            'valoresexamenes_inicio',
            'valoresexamenes_crear',
            'valoresexamenes_editar',
            'valoresexamenes_eliminar',
            'examenescompletos_inicio',
            'solicitudes_inicio',
            'solicitudes_crear',
            'llenado_resultados',
            'imprimir_proforma',
            'saldar_cuenta_solicitud',
            'citas_inicio',
            'confirmar_citas',
            'reservar_citas_inicio',
            'citas_crear',
            'citas_editar',
            'citas_eliminar',
            'reportes',
            'reporte_solicitudes_diarias',
            'reporte_solicitudes_por_fechas',
            'reporte_solicitudes_por_paciente',
            'reporte_por_examenes',
            'reportes_graficos',
            'vista_medicos',
            'vista_pacientes',
            'roles_permisos',
            'backup_inicio',
            'backup_crear',
            'backup_descargar',
            'backup_eliminar',
            'menu_inicio',
            'menu_solicitudes',
            'menu_examenes',
            'menu_reportes',
            'menu_usuarios',
            'menu_accesos',
            'menu_respaldos',
        ]);
        //buscamos al primer usuario y le asignamos el role admin
        $user = User::find(1);
        $user->assignRole('Administrador');
        $user->assignRole('Personal');


        $unidades = [
            [ 'unit'=>' %','description'=>'Porcentaje'],
            [ 'unit'=>' /mm3','description'=>'Milímetro cúbico'],
            [ 'unit'=>' cel/mm3','description'=>'células/mm3'],
         ];
        foreach($unidades as $u){
            Unidad::create($u);
        }
    }
}
