<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use RonasIT\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;
    use ModelTrait;

    protected $fillable = [
        'name',
    ];

    protected $hidden = ['pivot'];
}
