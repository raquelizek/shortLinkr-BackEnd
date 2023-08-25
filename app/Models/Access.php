<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ip',
        'user_agent',
        'user_clicked',
    ];
}
