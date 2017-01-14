<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Query\Builder;

/**
 * Class Position.
 *
 * @property int $id
 * @property string $name
 * @property int $priority
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 * @method static Builder|Position whereId($value)
 * @method static Builder|Position whereName($value)
 * @method static Builder|Position wherePriority($value)
 * @mixin \Eloquent
 */
class Position extends Model
{


    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'positions';


    /**
     * member.
     *
     * @return BelongsToMany;
     */
    public function members()
    {
        return $this->belongsToMany('App\Member');
    }

    /**
     * Assign a member.
     *
     * @param Member $member
     */
    public function assignMember($member)
    {
        $this->members()->attach($member);
    }

    /**
     * Remove a member.
     *
     * @param Member $member
     * @return int
     */
    public function removeMember($member)
    {
        return $this->members()->detach($member);
    }

}
