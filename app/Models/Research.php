<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Research
 *
 * @property int $id
 * @property int $human_id
 * @property string $research
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Research whereHumanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Research whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Research whereResearch($value)
 * @mixin \Eloquent
 */
class Research extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
