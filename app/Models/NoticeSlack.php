<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeSlack extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
    ];

    protected $casts = [
      'created_at' => 'datetime: Y-m-d H:i:s',
      'update_at' => 'datetime:Y-m-d H:i:s',
    ];
}
