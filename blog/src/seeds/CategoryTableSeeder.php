<?php

use Illuminate\Database\Seeder;

use Lembarek\Blog\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
       $categoriesLevel1 = factory(Category::class, 3)->create();
       foreach($categoriesLevel1 as $c1){
            $categoriesLevel2 = factory(Category::class, 3)->create(['parent' => $c1->id]);
            foreach($categoriesLevel2 as $c2){
                $categoriesLevel3 = factory(Category::class, 2)->create(['parent' => $c2->id]);
            }
       }

    }
}
