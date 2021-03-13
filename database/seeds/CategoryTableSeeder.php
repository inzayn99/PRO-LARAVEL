<?php

use Illuminate\Database\Seeder;
use App\Models\Category\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryData=[
          ['cat_name'=>'SPORTSWEAR','slug'=>'sportswear','posted_by'=>1],
          ['cat_name'=>'MENS','slug'=>'mens','posted_by'=>1],
          ['cat_name'=>'WOMENS','slug'=>'womens','posted_by'=>1],
          ['cat_name'=>'KIDS','slug'=>'kids','posted_by'=>1],
          ['cat_name'=>'FASHION','slug'=>'fashion','posted_by'=>1],
          ['cat_name'=>'HOUSEHOLDS','slug'=>'households','posted_by'=>1],
          ['cat_name'=>'INTERIOR','slug'=>'interior','posted_by'=>1],
          ['cat_name'=>'CLOTHING','slug'=>'clothing','posted_by'=>1],
          ['cat_name'=>'BAG','slug'=>'bag','posted_by'=>1],
          ['cat_name'=>'SHOES','slug'=>'shoes','posted_by'=>1]
        ];

        foreach($categoryData as $cat){
            Category::create($cat);
        }
    }
}
