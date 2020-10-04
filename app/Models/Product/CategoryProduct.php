<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table      = 'category_product';
    protected $primaryKey = 'id_category_product';
    public $timestamps    = true;

    public $fillable = ['description',
                        'status',
                        'created_at',
                        'updated_at'];
}
