<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder;
use Kalnoy\Nestedset\NodeTrait;


/**
 * Class Team.
 *
 * @property integer $id
 * @property string $name
 * @property string $year
 * @property integer $parent_id
 * @property-read int $_lft
 * @property-read int $_rgt
 * @property-read \App\Team $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @property-read \Kalnoy\Nestedset\Collection|\App\Team[] $children
 * @method static Builder|Team d()
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team whereYear($value)
 * @method static Builder|Team whereParentId($value)
 * @method static Builder|Team whereLft($value)
 * @method static Builder|Team whereRgt($value)
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
