<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string $year
 * @property int $_lft
 * @property int $_rgt
 * @property int $parent_id
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Team[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Member[] $members
 * @property-read \App\Models\Team $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team d()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Team whereYear($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use NodeTrait;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'teams';

    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Models\Member');
    }
}
