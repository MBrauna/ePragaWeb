<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id_product';
    public $timestamps    = true;

    public $fillable = ['description',
                        'id_category_product',
                        'quantity',
                        'measure',
                        'status',
                        'created_at',
                        'updated_at'];
}
