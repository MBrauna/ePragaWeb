<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'id';
    public $timestamps    = false;

    public $fillable = ['name', 
                        'cpf_cnpj', 
                        'mobile_access', 
                        'website_access',
                        'mobile_token', 
                        'last_login',
                        'email',
                        'password',
                        'api_token',
                        'created_at',
                        'updated_at'];
}
