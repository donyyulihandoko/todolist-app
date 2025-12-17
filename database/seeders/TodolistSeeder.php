<?php

namespace Database\Seeders;

use App\Models\Todolist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class TodolistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todolists')->truncate();
        Schema::disableForeignKeyConstraints();

        for ($i = 1; $i < 10; $i++) {
            Todolist::query()->create([
                'todo' => "Todolist$i",
                'description' => "Description Todolist $i",
                'category_id' => mt_rand(1, 9)
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
