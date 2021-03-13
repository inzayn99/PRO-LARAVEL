<?php

namespace App\Models\SubCategory;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable=[
        'sub_cat_name',
        'slug',
        'description',
        'meta_description',
        'meta_keywords',
        'status',
        'cat_id',
        'posted_by'
    ];
}
