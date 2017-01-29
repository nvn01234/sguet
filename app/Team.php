<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder;
use Kalnoy\Nestedset\NodeTrait;


/**
 * Class Team.
 *
 * @property integer $id
 * @property string $name
 * @property string $year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property integer $parent_id
 * @property-read \App\Team $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @property-read \Kalnoy\Nestedset\Collection|\App\Team[] $children
 * @method static Builder|Team d()
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team whereYear($value)
 * @method static Builder|Team whereCreatedAt($value)
 * @method static Builder|Team whereUpdatedAte($value)
 * @method static Builder|Team whereParentId($value)
 * @mixin \Eloquent
 * @property int $_lft
 * @property int $_rgt
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereRgt($value)
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
