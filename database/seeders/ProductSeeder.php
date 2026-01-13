<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [

            // ================= FLORAL (1) =================
            ['category_id' => 1, 'name' => 'Lumea Rose Bloom', 'description' => 'Aroma mawar segar yang lembut dan feminin', 'price' => 150000, 'stock' => 50],
            ['category_id' => 1, 'name' => 'Lumea Jasmine Pure', 'description' => 'Wangi melati elegan dan menenangkan', 'price' => 155000, 'stock' => 40],
            ['category_id' => 1, 'name' => 'Lumea Lily Soft', 'description' => 'Aroma lily lembut dan bersih', 'price' => 145000, 'stock' => 35],
            ['category_id' => 1, 'name' => 'Lumea Peony Bliss', 'description' => 'Peony manis modern', 'price' => 160000, 'stock' => 45],
            ['category_id' => 1, 'name' => 'Lumea Gardenia White', 'description' => 'Gardenia creamy elegan', 'price' => 165000, 'stock' => 30],
            ['category_id' => 1, 'name' => 'Lumea Floral Velvet', 'description' => 'Floral mewah dan halus', 'price' => 170000, 'stock' => 25],

            // ================= CITRUS / FRESH (2) =================
            ['category_id' => 2, 'name' => 'Lumea Lemon Zest', 'description' => 'Lemon segar dan energik', 'price' => 135000, 'stock' => 60],
            ['category_id' => 2, 'name' => 'Lumea Orange Splash', 'description' => 'Jeruk manis menyegarkan', 'price' => 140000, 'stock' => 55],
            ['category_id' => 2, 'name' => 'Lumea Bergamot Fresh', 'description' => 'Bergamot clean', 'price' => 145000, 'stock' => 45],
            ['category_id' => 2, 'name' => 'Lumea Citrus Bloom', 'description' => 'Citrus dengan floral', 'price' => 150000, 'stock' => 50],
            ['category_id' => 2, 'name' => 'Lumea Lime Breeze', 'description' => 'Lime dingin ringan', 'price' => 130000, 'stock' => 65],
            ['category_id' => 2, 'name' => 'Lumea Fresh Day', 'description' => 'Segar untuk harian', 'price' => 140000, 'stock' => 70],

            // ================= AQUATIC (3) =================
            ['category_id' => 3, 'name' => 'Lumea Ocean Blue', 'description' => 'Segar angin laut', 'price' => 155000, 'stock' => 50],
            ['category_id' => 3, 'name' => 'Lumea Sea Mist', 'description' => 'Kabut laut bersih', 'price' => 150000, 'stock' => 45],
            ['category_id' => 3, 'name' => 'Lumea Aqua Fresh', 'description' => 'Air segar modern', 'price' => 145000, 'stock' => 60],
            ['category_id' => 3, 'name' => 'Lumea Marine Wave', 'description' => 'Gelombang laut maskulin', 'price' => 160000, 'stock' => 40],
            ['category_id' => 3, 'name' => 'Lumea Blue Lagoon', 'description' => 'Aquatic tropis', 'price' => 165000, 'stock' => 35],
            ['category_id' => 3, 'name' => 'Lumea Crystal Water', 'description' => 'Air jernih clean', 'price' => 150000, 'stock' => 55],

            // ================= GOURMAND (4) =================
            ['category_id' => 4, 'name' => 'Lumea Vanilla Sugar', 'description' => 'Vanilla manis', 'price' => 170000, 'stock' => 40],
            ['category_id' => 4, 'name' => 'Lumea Caramel Dream', 'description' => 'Caramel creamy', 'price' => 175000, 'stock' => 35],
            ['category_id' => 4, 'name' => 'Lumea Chocolate Bliss', 'description' => 'Coklat lembut', 'price' => 180000, 'stock' => 30],
            ['category_id' => 4, 'name' => 'Lumea Honey Cake', 'description' => 'Madu dan cake', 'price' => 165000, 'stock' => 45],
            ['category_id' => 4, 'name' => 'Lumea Sweet Latte', 'description' => 'Kopi susu manis', 'price' => 160000, 'stock' => 50],
            ['category_id' => 4, 'name' => 'Lumea Vanilla Cloud', 'description' => 'Vanilla cozy', 'price' => 170000, 'stock' => 38],

            // ================= ORIENTAL (5) =================
            ['category_id' => 5, 'name' => 'Lumea Amber Gold', 'description' => 'Amber hangat sensual', 'price' => 190000, 'stock' => 30],
            ['category_id' => 5, 'name' => 'Lumea Oud Velvet', 'description' => 'Oud mewah', 'price' => 220000, 'stock' => 20],
            ['category_id' => 5, 'name' => 'Lumea Spice Night', 'description' => 'Rempah malam hari', 'price' => 185000, 'stock' => 25],
            ['category_id' => 5, 'name' => 'Lumea Oriental Silk', 'description' => 'Oriental elegan', 'price' => 200000, 'stock' => 22],
            ['category_id' => 5, 'name' => 'Lumea Incense Dark', 'description' => 'Dupa eksotis', 'price' => 195000, 'stock' => 28],
            ['category_id' => 5, 'name' => 'Lumea Royal Amber', 'description' => 'Amber mewah', 'price' => 210000, 'stock' => 18],

            // ================= WOODY (6) =================
            ['category_id' => 6, 'name' => 'Lumea Sandalwood Soft', 'description' => 'Cendana lembut', 'price' => 175000, 'stock' => 40],
            ['category_id' => 6, 'name' => 'Lumea Cedar Clean', 'description' => 'Cedar bersih', 'price' => 170000, 'stock' => 45],
            ['category_id' => 6, 'name' => 'Lumea Woody Musk', 'description' => 'Woody musk', 'price' => 180000, 'stock' => 35],
            ['category_id' => 6, 'name' => 'Lumea Forest Noir', 'description' => 'Hutan kayu gelap', 'price' => 185000, 'stock' => 30],
            ['category_id' => 6, 'name' => 'Lumea Patchouli Wood', 'description' => 'Patchouli earthy', 'price' => 190000, 'stock' => 28],
            ['category_id' => 6, 'name' => 'Lumea Wood Essence', 'description' => 'Kayu alami', 'price' => 175000, 'stock' => 50],
        ];

        foreach ($products as $product) {
            Product::create([
                ...$product,
                'slug' => Str::slug($product['name']),
            ]);
        }
    }
}
