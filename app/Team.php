<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder;
use Kalnoy\Nestedset\NodeTrait;


/**
 * App\Team
 *
 * @property int $id
 * @property string $name
 * @property string $year
 * @property int $_lft
 * @property int $_rgt
 * @property int $parent_id
 * @property-read \Kalnoy\Nestedset\Collection|\App\Team[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @property-read \App\Team $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Team d()
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereYear($value)
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
    
    protected $fillable = ['name', 'year', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
