<?php

namespace App\Models\Companie;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table      = 'company';
    protected $primaryKey = 'id_company';
    public $timestamps    = true;

    public $fillable = ['id_responsible',
                        'name',
                        'initials',
                        'state_registration',
                        'munipal_registration',
                        'fantasy_name',
                        'type_person',
                        'status',
                        'created_at',
                        'updated_at'];
}
