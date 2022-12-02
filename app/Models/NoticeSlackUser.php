<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NoticeSlackUser extends Authenticatable
{
    use  Notifiable, HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',

        ///
        'mobile',
        'options',
        'state',
        'tel',
        'type',
        ////
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
      'email_verified_at' => 'datetime',
      'created_at' => 'datetime: Y-m-d H:i:s',
      'options' => 'array',
      'update_at' => 'datetime:Y-m-d H:i:s',
    ];

}
