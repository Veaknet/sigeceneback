<?php

use Illuminate\Database\Seeder;
use App\TypeQuestion;

class TypeQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types =[
	        [
	            "name"  => "Respuesta breve"
	        ],
	        [
	            "name"  => "párrafo"
	        ],
	        [
	            "name"  => "Selección simple"
	        ],
	        [
	            "name"  => "Selección multiple"
	        ],
	        [
	            "name"  => "Lista desplegable simple"
	        ],
	        [
	            "name"  => "Lista desplegable multiple"
	        ],
	        [
	            "name"  => "Escala lineal"
	        ],
	        [
	            "name"  => "Cuadrícula de opción multiple"
	        ],
	        [
	            "name"  => "Cuadrícula de casillas verificables"
	        ],
	        [
	            "name"  => "Fecha"
	        ],
	        [
	            "name"  => "Hora"
	        ]
	    ];
    	//DB::table('users')->delete();
	    foreach ($types as $type){
	        TypeQuestion::create($type);
	    }
    }
}
