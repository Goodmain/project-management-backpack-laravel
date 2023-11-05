<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RonasIT\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use ModelTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    protected $hidden = ['pivot'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
