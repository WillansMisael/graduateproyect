<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosiblesResultados;
class PosiblesResultadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posibles_resultados = [
            ['description'=>'Abundantes'],
            ['description'=>'Ac. Nalidixico'],
            ['description'=>'Amarillo ambar'],
            ['description'=>'Amikacina'],
            ['description'=>'Amoxicilina'],
            ['description'=>'Amoxicilina / Ac. clavulanico'],
            ['description'=>'Ampicilina'],
            ['description'=>'Ampicilina / Sulbactam'],
            ['description'=>'Aniso'],
            ['description'=>'Ausentes'],
            ['description'=>'Aztreonam'],
            ['description'=>'Blanca fugaz'],
            ['description'=>'Blanca persistente'],
            ['description'=>'Caoba'],
            ['description'=>'Cefalotina'],
            ['description'=>'Cefotaxima'],
            ['description'=>'Cefradina'],
            ['description'=>'Ceftazidima'],
            ['description'=>'Claro'],
            ['description'=>'Contiene Valor'],
            ['description'=>'Cotrimoxazol'],
            ['description'=>'Escasas'],
            ['description'=>'Esporadicas'],
            ['description'=>'Fetido'],
            ['description'=>'Gentamicina'],
            ['description'=>'Leve'],
            ['description'=>'Lig. Fetido'],
            ['description'=>'Lig. Opalescente'],
            ['description'=>'Límpido'],
            ['description'=>'Marcada'],
            ['description'=>'Moderada'],
            ['description'=>'Naranja'],
            ['description'=>'Negativo'],
            ['description'=>'Negativo'],
            ['description'=>'Nitrofurantoina'],
            ['description'=>'No contiene'],
            ['description'=>'No reactivo'],
            ['description'=>'Norfloxacina'],
            ['description'=>'Normal'],
            ['description'=>'Opalescente'],
            ['description'=>'Oscuro'],
            ['description'=>'Pajizo'],
            ['description'=>'Positivo'],
            ['description'=>'Positivo (+)'],
            ['description'=>'Positivo (++)'],
            ['description'=>'Positivo (+++)'],
            ['description'=>'Positivo 1/128'],
            ['description'=>'Positivo 1/160'],
            ['description'=>'Positivo 1/32'],
            ['description'=>'Positivo 1/320'],
            ['description'=>'Positivo 1/64'],
            ['description'=>'Positivo 1/80'],
            ['description'=>'Presentes'],
            ['description'=>'Reactivo'],
            ['description'=>'Regular'],
            ['description'=>'Rojo'],
            ['description'=>'Sui-generis'],
            ['description'=>'Trazas'],
            ['description'=>'Turbio'],
            ['description'=>'Escaso'],
            ['description'=>'O'],
            ['description'=>'Positivo 1/16'],
            ['description'=>'Positivo 1/32'],
            ['description'=>'Positivo 1/64'],
            ['description'=>'Positivo 1/128'],
            ['description'=>'Positivo 1/256'],
        ];
        foreach($posibles_resultados as $pr){
            PosiblesResultados::create($pr);
        }
    }
}
