<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectType::create
        (['name' => 'Technology Projects',
        'description' => 'I specialize in developing websites, creating intuitive front-end interfaces and other tech projects. My projects highlight my ability to leverage technology effectively to deliver user-friendly and visually appealing digital experiences.']);
        ProjectType::create
        (['name' => 'Visual Projects',
        'description' => 'Under my freelance brand Tom Visual, I specialize in photography and videography, crafting compelling visual narratives to elevate brand identities and capture memorable moments.']);
    }
}
