<?php

namespace App\Models\Prague;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    protected $table      = 'treatment';
    protected $primaryKey = 'id_treatment';
    public $timestamps    = true;

    public $fillable = ['name',
                        'description',
                        'id_prague',
                        'status',
                        'created_at',
                        'updated_at'];
}
