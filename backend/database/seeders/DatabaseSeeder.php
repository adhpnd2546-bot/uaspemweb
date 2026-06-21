<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin TaniPantau',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas Lapang',
            'email' => 'petugas@petugas.com',
            'password' => bcrypt('123'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Petugas Kedua',
            'email' => 'petugas2@petugas2.com',
            'password' => bcrypt('123'),
            'role' => 'petugas',
        ]);

        User::create([
            'name' => 'Manajer Koordinator',
            'email' => 'manajer@manajer.com',
            'password' => bcrypt('123'),
            'role' => 'manajer',
        ]);

        $this->call([
            WilayahSeeder::class,
            PetaniSeeder::class,
            LahanSeeder::class,
            KunjunganSeeder::class,
        ]);
    }
}
