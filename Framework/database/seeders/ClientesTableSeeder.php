<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        // Generar 10 clientes con datos falsos
        for ($i = 0 ; $i < 30; $i++) {
            DB::table('clientes')->insert([
                'nombre' => $faker->firstName,
                'apellido' => $faker->lastName,
                'email' => $faker->email,
                'provincia' => $faker->state,
                'telefono' => '0299'.$faker->randomNumber(8, true),
                'direccion' => $faker->address." ".$faker->randomNumber(3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
