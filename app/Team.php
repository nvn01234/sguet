<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder;
use Kalnoy\Nestedset\NodeTrait;


/**
 * Class Team.
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property int $parent_id
 * @property int $_lft
 * @property int $_rgt
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @property-read \App\Team $parent
 * @property-read \Kalnoy\Nestedset\Collection|\App\Team[] $children
 * @method static Builder|Team whereId($value)
 * @method static Builder|Team whereName($value)
 * @method static Builder|Team wherePriority($value)
 * @method static Builder|Team whereLft($value)
 * @method static Builder|Team whereRgt($value)
 * @method static Builder|Team whereParentId($value)
 * @method static Builder|Team d()
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany('App\Member');
    }

    /**
     * @param Member $member
     */
    public function assignMember($member)
    {
        $this->members()->attach($member);
    }

    /**
     * @param Member $member
     * @return int
     */
    public function removeMember($member)
    {
        return $this->members()->detach($member);
    }
}
