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
            'main_image' => 'https://example.com/images/portfolio.jpg',
            'project_type' => 1, 
            'year' => 2024,
            'content' => 'Ini adalah website portfolio untuk menampilkan karya-karya terbaru.'
        ]);

        Project::create([
            'title' => 'Mobile Banking App',
            'main_image' => 'https://example.com/images/mobile-banking.jpg',
            'project_type' => 2, 
            'year' => 2024,
            'content' => 'Aplikasi mobile untuk memudahkan transaksi perbankan.'
        ]);

        Project::create([
            'title' => 'E-commerce Website',
            'main_image' => 'https://example.com/images/ecommerce.jpg',
            'project_type' => 1, 
            'year' => 2023,
            'content' => 'Sebuah website untuk berbelanja online.'
        ]);
    }
}
