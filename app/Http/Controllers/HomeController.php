<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProperties = [
            [
                'id' => '1',
                'title' => 'Casa moderna con jardín',
                'description' => 'Hermosa casa de 3 habitaciones con amplio jardín y piscina',
                'price' => 250000,
                'location' => 'Santiago Centro',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 150,
                'type' => 'venta',
                'imageUrl' => '/images/property1.jpg',
            ],
            [
                'id' => '2',
                'title' => 'Apartamento céntrico',
                'description' => 'Apartamento de 2 habitaciones en el centro de la ciudad',
                'price' => 800,
                'location' => 'Providencia',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'area' => 75,
                'type' => 'arriendo',
                'imageUrl' => '/images/property2.jpg',
            ],
            [
                'id' => '3',
                'title' => 'Casa familiar en condominio',
                'description' => 'Espaciosa casa en condominio cerrado con seguridad 24/7',
                'price' => 320000,
                'location' => 'Las Condes',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 200,
                'type' => 'venta',
                'imageUrl' => '/images/property3.jpg',
            ],
        ];

        return view('welcome', compact('featuredProperties'));
    }
}