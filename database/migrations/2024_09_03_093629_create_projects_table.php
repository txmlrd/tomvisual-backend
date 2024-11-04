<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('main_image');
            $table->string('title', 255);
            $table->unsignedBigInteger('project_type');
            $table->integer('year');
            $table->string('url');
            $table->text('content');
            $table->
            $table->timestamps();

            $table->foreign('project_type')->references('id')->on('project_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
