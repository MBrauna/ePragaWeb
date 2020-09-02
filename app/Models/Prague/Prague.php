<?php

namespace App\Models\Prague;

use Illuminate\Database\Eloquent\Model;

class Prague extends Model
{
    protected $table      = 'prague';
    protected $primaryKey = 'id_prague';
    public $timestamps    = true;

    public $fillable = ['name',
                        'description',
                        'status',
                        'created_at',
                        'updated_at'];
}
