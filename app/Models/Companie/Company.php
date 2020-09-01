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
                        'contract_start',
                        'contract_due',
                        'status',
                        'created_at',
                        'updated_at'];
}
