<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use RonasIT\Support\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    use ModelTrait;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    protected $hidden = ['pivot'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class)
            ->orderBy('id');
    }
}
