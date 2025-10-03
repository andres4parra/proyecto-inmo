<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Propiedad;

class PropiedadSeeder extends Seeder
{
    public function run()
    {
        Propiedad::create([
            'titulo' => 'Casa Familiar en el Norte',
            'descripcion' => 'Hermosa casa de 3 habitaciones, amplia sala y jardín privado.',
            'precio' => 350000000,
            'ciudad' => 'Bucaramanga',
            'ubicacion' => 'Calle 45 #23-12',
            'tipo' => 'venta',
            'habitaciones' => 3,
            'banos' => 2,
            'area' => 120,
        ]);

        Propiedad::create([
            'titulo' => 'Apartamento Moderno en el Centro',
            'descripcion' => 'Apartamento con excelente vista y acabados de lujo.',
            'precio' => 1800000,
            'ciudad' => 'Bucaramanga',
            'ubicacion' => 'Carrera 27 #15-20',
            'tipo' => 'arriendo',
            'habitaciones' => 2,
            'banos' => 2,
            'area' => 80,
        ]);
    }
}
