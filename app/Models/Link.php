<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Link
 *
 * @property int $id
 * @property string $url
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Link whereUrl($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    public $timestamps = false;
    protected $table = 'links';
    protected $guarded = [];
}
