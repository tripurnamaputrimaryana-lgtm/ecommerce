<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Floral',
                'slug' => 'floral',
                'description' => 'Aroma bunga yang lembut, romantis, dan feminin',
                'is_active' => true,
            ],
            [
                'name' => 'Woody',
                'slug' => 'woody',
                'description' => 'Aroma kayu yang hangat, elegan, dan maskulin',
                'is_active' => true,
            ],
            [
                'name' => 'Oriental',
                'slug' => 'oriental',
                'description' => 'Aroma eksotis dengan sentuhan rempah dan manis',
                'is_active' => true,
            ],
            [
                'name' => 'Fresh / Citrus',
                'slug' => 'fresh-citrus',
                'description' => 'Aroma segar dari jeruk dan buah citrus',
                'is_active' => true,
            ],
            [
                'name' => 'Aquatic',
                'slug' => 'aquatic',
                'description' => 'Aroma segar seperti laut dan air',
                'is_active' => true,
            ],
            [
                'name' => 'Gourmand',
                'slug' => 'gourmand',
                'description' => 'Aroma manis seperti vanila, coklat, dan dessert',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Categories seeded successfully!');
    }
}
