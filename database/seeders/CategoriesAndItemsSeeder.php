<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;
use Faker\Factory as Faker;

class CategoriesAndItemsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create Categories
        $braceletCategory = Category::create(['name' => 'Bracelet', 'description' => 'Beautiful bracelets made from various minerals']);
        $necklaceCategory = Category::create(['name' => 'Necklace', 'description' => 'Elegant necklaces inspired by tropical flowers']);
        $earringsCategory = Category::create(['name' => 'Earrings', 'description' => 'Exotic earrings inspired by tropical animals']);

        // Minerals for bracelets
        $minerals = [
            'Amethyst', 'Jade', 'Turquoise', 'Lapis Lazuli', 'Rose Quartz', 'Tiger\'s Eye', 'Onyx', 'Malachite',
            'Moonstone', 'Jasper', 'Agate', 'Carnelian', 'Citrine', 'Aventurine', 'Opal'
        ];

        // Latin names of tropical flowers for necklaces
        $flowers = [
            'Heliconia bihai', 'Strelitzia reginae', 'Plumeria rubra', 'Hibiscus rosa-sinensis', 'Anthurium andraeanum',
            'Orchidaceae phalaenopsis', 'Passiflora caerulea', 'Alpinia purpurata', 'Etlingera elatior', 'Ixora coccinea'
        ];

        // Latin names of tropical animals for earrings
        $animals = [
            'Panthera onca', 'Ara macao', 'Morpho peleides', 'Iguana iguana', 'Dendrobates tinctorius'
        ];

        // Create Items for Bracelets
        foreach ($minerals as $mineral) {
            Item::create([
                'name' => $mineral,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 15, 60),
                'stock' => $faker->numberBetween(1, 10),
                'online' => $faker->boolean(80),
                'category_id' => $braceletCategory->id,
            ]);
        }

        // Create Items for Necklaces
        foreach ($flowers as $flower) {
            Item::create([
                'name' => $flower,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 20, 70),
                'stock' => $faker->numberBetween(1, 5),
                'online' => $faker->boolean(80),
                'category_id' => $necklaceCategory->id,
            ]);
        }

        // Create Items for Earrings
        foreach ($animals as $animal) {
            Item::create([
                'name' => $animal,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 60),
                'stock' => $faker->numberBetween(1, 3),
                'online' => $faker->boolean(80),
                'category_id' => $earringsCategory->id,
            ]);
        }
    }
}
