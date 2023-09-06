<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Card
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $card_number
 * @property Carbon $expiration_date
 * @property string $cvv
 * @property string $cardholder_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Card newModelQuery()
 * @method static Builder|Card newQuery()
 * @method static Builder|Card query()
 * @method static Builder|Card whereCardNumber($value)
 * @method static Builder|Card whereCardholderName($value)
 * @method static Builder|Card whereCreatedAt($value)
 * @method static Builder|Card whereCvv($value)
 * @method static Builder|Card whereExpirationDate($value)
 * @method static Builder|Card whereId($value)
 * @method static Builder|Card whereUpdatedAt($value)
 * @method static Builder|Card whereUserId($value)
 * @method static Builder|Card whereUuid($value)
 * @mixin Eloquent
 */
class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'card_number',
        'expiration_date',
        'cvv',
        'cardholder_name',
    ];

    protected $casts = [
        'expiration_date' => 'date',
    ];
}
