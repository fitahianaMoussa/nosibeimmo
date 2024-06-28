<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Immobilier;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(2)->create()->each(function ($category) {
            $category->subcategories()->create(
                Subcategory::factory(6)->make()
            )->each(function ($subcategory) {
                $subcategory->immobiliers()->saveMany(
                    Immobilier::factory(10)->make()
                )->each(function ($immobilier) {
                    $immobilier->images()->saveMany(
                        Image::factory(5)->make()
                    );
                });
            });
        });
    }
}

