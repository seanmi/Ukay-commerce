<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'jacket',
        ]);
        Category::create([
            'name' => 'jeans',
        ]);
        Category::create([
            'name' => 'miniskirt',
        ]);
        Category::create([
            'name' => 'blouse',
        ]);
    }
}
