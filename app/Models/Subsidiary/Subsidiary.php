<?php

namespace App\Models\Subsidiary;

use Illuminate\Database\Eloquent\Model;

class Subsidiary extends Model
{
    protected $table      = 'subsidiary';
    protected $primaryKey = 'id_subsidiary';
    public $timestamps    = true;

    public $fillable = ['id_company',
                        'name',
                        'description',
                        'id_prague',
                        'status',
                        'address',
                        'latitude',
                        'longitude',
                        'created_at',
                        'updated_at'];
}
