<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;
use App\Models\Inventory;
use Faker\Factory as Faker;

class CategoriesAndItemsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create Categories
        $braceletCategory = Category::create(['name' => 'Bracelet', 'description' => 'Beautiful bracelets made from various minerals', 'online' => true]);
        $necklaceCategory = Category::create(['name' => 'Necklace', 'description' => 'Elegant necklaces inspired by tropical flowers', 'online' => true]);
        $earringsCategory = Category::create(['name' => 'Earrings', 'description' => 'Exotic earrings inspired by tropical animals', 'online' => true]);

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
            $item = Item::create([
                'name' => $mineral,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 15, 60),
                'online' => $faker->boolean(80),
                'category_id' => $braceletCategory->id,
            ]);

            Inventory::create([
                'item_id' => $item->id,
                'quantity' => $faker->numberBetween(1, 10),
            ]);
        }

        // Create Items for Necklaces
        foreach ($flowers as $flower) {
            $item = Item::create([
                'name' => $flower,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 20, 70),
                'online' => $faker->boolean(80),
                'category_id' => $necklaceCategory->id,
            ]);

            Inventory::create([
                'item_id' => $item->id,
                'quantity' => $faker->numberBetween(1, 5),
            ]);
        }

        // Create Items for Earrings
        foreach ($animals as $animal) {
            $item = Item::create([
                'name' => $animal,
                'description' => $faker->paragraph,
                'price' => $faker->randomFloat(2, 10, 60),
                'online' => $faker->boolean(80),
                'category_id' => $earringsCategory->id,
            ]);

            Inventory::create([
                'item_id' => $item->id,
                'quantity' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}
