<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
    [
        'firstName' => 'Juan',
        'lastName' => 'Pérez',
        'username' => 'juanperez',
        'email' => 'juan.perez@example.com',
        'password' => bcrypt('securepassword1'),
        'description' => 'Un usuario de prueba para la aplicación.'
    ],
    [
        'firstName' => 'Ana',
        'lastName' => 'Gómez',
        'username' => 'anagomez',
        'email' => 'ana.gomez@example.com',
        'password' => bcrypt('securepassword2'),
        'description' => 'Otro usuario de prueba para la aplicación.'
    ],
    [
        'firstName' => 'Carlos',
        'lastName' => 'López',
        'username' => 'carloslopez',
        'email' => 'carlos.lopez@example.com',
        'password' => bcrypt('securepassword3'),
        'description' => 'Más datos de prueba para la aplicación.'
    ],
    [
        'firstName' => 'María',
        'lastName' => 'Martínez',
        'username' => 'mariamartinez',
        'email' => 'maria.martinez@example.com',
        'password' => bcrypt('securepassword4'),
        'description' => 'Aquí hay otro conjunto de datos de prueba.'
    ],
    [
        'firstName' => 'Luis',
        'lastName' => 'Sánchez',
        'username' => 'luissanchez',
        'email' => 'luis.sanchez@example.com',
        'password' => bcrypt('securepassword5'),
        'description' => 'Último usuario de prueba en este arreglo.'
    ],
];


        foreach ($users as $user) {
            User::create($user);
        }
    }
}