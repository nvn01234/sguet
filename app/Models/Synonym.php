<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Synonym
 *
 * @property int $id
 * @property string $synonyms
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Synonym whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Synonym whereSynonyms($value)
 * @mixin \Eloquent
 */
class Synonym extends Model
{
    protected $table = 'synonyms';
    protected $guarded = [];
    public $timestamps = false;
}
