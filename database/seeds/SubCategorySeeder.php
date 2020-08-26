<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubCategory::create([
            'category_id' => 1,
            'name' => 'Painting'
        ]);

        SubCategory::create([
            'category_id' => 1,
            'name' => 'Crafts'
        ]);

        SubCategory::create([
            'category_id' => 2,
            'name' => 'Botany'
        ]);

        SubCategory::create([
            'category_id' => 2,
            'name' => 'Zoology'
        ]);

        SubCategory::create([
            'category_id' => 3,
            'name' => 'Indian'
        ]);

        SubCategory::create([
            'category_id' => 3,
            'name' => 'American'
        ]);
    }
}
