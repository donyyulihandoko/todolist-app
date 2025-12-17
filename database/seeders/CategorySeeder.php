<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->truncate();
        Schema::disableForeignKeyConstraints();

        for ($i = 1; $i < 10; $i++) {
            Category::query()->create([
                'name' => "Category $i",
                'description' => "Description Category $i"
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
