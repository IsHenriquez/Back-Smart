<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\UserType;
use App\Models\VehiclesBrand;
use App\Models\VehiclesModel;
use App\Models\TicketsCategory;
use App\Models\TicketsPriority;
use App\Models\TicketsStatus;
use App\Models\TicketsType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Insertar marcas de vehículos
        VehiclesBrand::insert($this->getVBrands());

        // Insertar modelos de vehículos
        VehiclesModel::insert($this->getVModels());

        TicketsCategory::insert([
            [
                'name' => 'Trabajo',
            ],
            [
                'name' => 'Personal'
            ]
        ]);
        TicketsPriority::insert([
            [
                'name' => 'Baja',
            ],
            [
                'name' => 'Media'
            ],
            [
                'name' => 'Alta'
            ]
        ]);
        TicketsStatus::insert([
            [
                'name' => 'Pendiente',
            ],
            [
                'name' => 'Activo'
            ],
            [
                'name' => 'Terminado'
            ]
        ]);
        TicketsType::insert([
            [
                'name' => 'Ticket',
            ],
            [
                'name' => 'Cita'
            ]
        ]);
        //TIPO USUARIO//
        UserType::insert([
            [
                'name' => 'Administrador/a',
                'description' => 'Rol de administrador del sistema'
            ],
            [
                'name' => 'Técnico/a',
                'description' => 'Rol de técnico de mantenimiento'
            ],
            [
                'name' => 'Secretario/a',
                'description' => 'Rol de secretario/a del sistema'
            ]
        ]);
        //FIN TIPO USUARIO//
        //CREAR USUARIOS//
        User::insert([
            [
                'active' => 1,
                'id_user_type' => 1,
                'name' => 'Benjamín',
                'last_name' => 'Araya',
                'email' => 'benjamin@smarttechnical.com',
                'password' => Hash::make('Benjamin2023'),
            ],
            [
                'active' => 1,
                'id_user_type' => 1,
                'name' => 'Isadora',
                'last_name' => 'Henriquez',
                'email' => 'isadora@smarttechnical.com',
                'password' => Hash::make('Isadora2023'),
            ]
        ]);
        $cont=0;
        for ($i = 1; $i <= 5; $i++) {
            $name = $this->getName($cont);
            $email = Str::lower($name) . '@smarttechnical.com';
            User::create([
                'active' => 1,
                'id_user_type' => 2,
                'name' => ucfirst($name),
                'last_name' => $this->getLastName(),
                'email' => $email,
                'password' => Hash::make(ucfirst($name) . '2023'),
            ]);
            $cont++;
        }
        for ($i = 1; $i <= 5; $i++) {
            $name = $this->getName($cont);
            $email = Str::lower($name) . '@smarttechnical.com';
            User::create([
                'active' => 1,
                'id_user_type' => 3,
                'name' => ucfirst($name),
                'last_name' => $this->getLastName(),
                'email' => $email,
                'password' => Hash::make(ucfirst($name) . '2023'),
            ]);
            $cont++;
        }
        //FIN CREAR USUARIOS//
    }

    private function getName($index)
    {
        $names = [
            'Juan', 'Maria', 'Pedro', 'Ana', 'Luis', 'Laura', 'Carlos', 'Sofia', 'Javier', 'Valeria'
        ];
        return $names[$index];
    }

    private function getLastName()
    {
        $lastNames = [
            'Gonzalez', 'Rodriguez', 'Lopez', 'Martinez', 'Perez', 'Gomez', 'Fernandez', 'Ramirez', 'Sanchez', 'Torres',
            'Silva', 'Hernandez', 'Juarez', 'Romero', 'Navarro', 'Garcia', 'Vargas', 'Ortega', 'Ramos', 'Cruz',
            'Molina', 'Castillo', 'Soto', 'Delgado', 'Rojas', 'Cortes', 'Campos', 'Ponce', 'Medina', 'Vega',
            'Mendez', 'Guerrero', 'Valencia', 'Valenzuela', 'Espinoza', 'Ojeda', 'Rivera', 'Flores', 'Gutierrez', 'Reyes',
            'Baez', 'Fuentes', 'Aguilar', 'Carrasco', 'Montes', 'Morales', 'Paredes', 'Vera', 'Velasquez', 'Miranda',
            'Serrano', 'Rios', 'Contreras', 'Maldonado', 'Sepulveda', 'Cabrera', 'Tapia', 'Godoy', 'Castro', 'Araya',
            'Herrera', 'Saez', 'Muñoz', 'Rojo', 'Santos', 'Vidal', 'Carvajal', 'Valdes', 'Bravo', 'Leiva',
            'Lagos', 'Cisternas', 'Escobar', 'Bustamante', 'Caceres', 'Pizarro', 'Moya', 'Venegas', 'Cordova', 'Cuevas',
            'Vera', 'Donoso', 'Lara', 'Salazar', 'Poblete', 'Hidalgo', 'Orellana', 'Vargas', 'Pizarro', 'Arancibia',
        ];
        return $lastNames[array_rand($lastNames)];
    }

    private function getVModels()
    {
        $models = [
            // Toyota
            ['name' => 'Yaris', 'id_vehicles_brand' => 1],
            ['name' => 'Corolla', 'id_vehicles_brand' => 1],
            ['name' => 'Rav4', 'id_vehicles_brand' => 1],
            ['name' => 'Hilux', 'id_vehicles_brand' => 1],
            ['name' => 'Land Cruiser', 'id_vehicles_brand' => 1],

            // Chevrolet
            ['name' => 'Spark', 'id_vehicles_brand' => 2],
            ['name' => 'Cruze', 'id_vehicles_brand' => 2],
            ['name' => 'Trax', 'id_vehicles_brand' => 2],
            ['name' => 'Equinox', 'id_vehicles_brand' => 2],
            ['name' => 'Silverado', 'id_vehicles_brand' => 2],

            // Nissan
            ['name' => 'Versa', 'id_vehicles_brand' => 3],
            ['name' => 'Sentra', 'id_vehicles_brand' => 3],
            ['name' => 'X-Trail', 'id_vehicles_brand' => 3],
            ['name' => 'Kicks', 'id_vehicles_brand' => 3],
            ['name' => 'Frontier', 'id_vehicles_brand' => 3],
        ];
        return $models;
    }

    private function getVBrands()
    {
        $brands = [
            ['name' => 'Toyota'],
            ['name' => 'Chevrolet'],
            ['name' => 'Nissan'],
        ];
        return $brands;
    }
}
