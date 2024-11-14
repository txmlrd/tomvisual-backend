<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'title' => 'Website Portfolio',
            'project_type' => 1,
            'year' => 2024,
            'content' => 'Ini adalah website portfolio untuk menampilkan karya-karya terbaru.',
            'url' => 'google.com'
        ]);

        Project::create([
            'title' => 'Mobile Banking App',
            'project_type' => 2,
            'year' => 2024,
            'content' => 'Aplikasi mobile untuk memudahkan transaksi perbankan.',
            'url' => 'google.com'
        ]);

        Project::create([
            'title' => 'E-commerce Website',
            'project_type' => 1,
            'year' => 2023,
            'content' => 'Sebuah website untuk berbelanja online.',
            'url' => 'google.com'
        ]);
    }
}
