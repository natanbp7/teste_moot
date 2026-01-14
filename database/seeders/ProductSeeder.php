<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();

        foreach (range(1, 30) as $i) {
            Product::create([
                'name' => "Produto {$i}",
                'brand_id' => $brands->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }
    }
}
