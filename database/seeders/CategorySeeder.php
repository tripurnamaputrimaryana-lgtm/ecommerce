<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'id' => 1,
                'name' => 'Floral',
                'slug' => Str::slug('Floral'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Citrus/Fresh',
                'slug' => Str::slug('Citrus Fresh'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Aquatic',
                'slug' => Str::slug('Aquatic'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Gourmand',
                'slug' => Str::slug('Gourmand'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Oriental',
                'slug' => Str::slug('Oriental'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Woody',
                'slug' => Str::slug('Woody'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
