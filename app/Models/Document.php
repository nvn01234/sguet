<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Document whereUrl($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function toElasticData() {
        return $this->toArray();
    }
}
