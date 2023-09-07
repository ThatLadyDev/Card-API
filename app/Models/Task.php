<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Task
 *
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property bool $is_finished
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Task whereUserId($value)
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereIsFinished($value)
 * @method static Builder|Task whereStatus($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @method static Builder|Task whereUuid($value)
 * @mixin Eloquent
 * @property string $type
 * @method static Builder|Task whereType($value)
 * @mixin Eloquent
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'is_finished',
        'progress',
        'type',
    ];

    protected $casts = [
        'is_finished' => 'boolean'
    ];
}
