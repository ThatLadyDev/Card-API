<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\CardSwitch
 *
 * @property int $id
 * @property string $uuid
 * @property int $new_card_id
 * @property int $task_id
 * @property int $merchant_id
 * @property int $previous_card_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|CardSwitch newModelQuery()
 * @method static Builder|CardSwitch newQuery()
 * @method static Builder|CardSwitch query()
 * @method static Builder|CardSwitch whereCreatedAt($value)
 * @method static Builder|CardSwitch whereId($value)
 * @method static Builder|CardSwitch whereTaskId($value)
 * @method static Builder|CardSwitch whereMerchantId($value)
 * @method static Builder|CardSwitch whereNewCardId($value)
 * @method static Builder|CardSwitch wherePreviousCardId($value)
 * @method static Builder|CardSwitch whereUpdatedAt($value)
 * @method static Builder|CardSwitch whereUuid($value)
 * @mixin Eloquent
 */
class CardSwitch extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'task_id',
        'new_card_id',
        'merchant_id',
        'previous_card_id',
    ];
}
