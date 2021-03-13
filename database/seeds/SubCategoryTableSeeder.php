<?php

use Illuminate\Database\Seeder;
use App\Models\SubCategory\SubCategory;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subCategoryData=[
            ['sub_cat_name'=>'UNDER ARMOUR','slug'=>'under armour','cat_id'=>1,'posted_by'=>1],
            ['sub_cat_name'=>'NIKE','slug'=>'nike','cat_id'=>2,'posted_by'=>1],
            ['sub_cat_name'=>'ADIDAS','slug'=>'adidas','cat_id'=>1,'posted_by'=>1],
            ['sub_cat_name'=>'PUMA','slug'=>'puma','cat_id'=>2,'posted_by'=>1],
            ['sub_cat_name'=>'ASICS','slug'=>'asics','cat_id'=>1,'posted_by'=>1],
        ];

        foreach($subCategoryData as $subCat){
            SubCategory::create($subCat);
        }
    }
}
