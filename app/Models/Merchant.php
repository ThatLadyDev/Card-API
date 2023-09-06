<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $website
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Merchant newModelQuery()
 * @method static Builder|Merchant newQuery()
 * @method static Builder|Merchant query()
 * @method static Builder|Merchant whereCreatedAt($value)
 * @method static Builder|Merchant whereId($value)
 * @method static Builder|Merchant whereName($value)
 * @method static Builder|Merchant whereUpdatedAt($value)
 * @method static Builder|Merchant whereUuid($value)
 * @method static Builder|Merchant whereWebsite($value)
 * @mixin Eloquent
 */
class Merchant extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'website',
    ];
}
