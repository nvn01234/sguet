<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use \Illuminate\Database\Query\Builder;

/**
 * Class Member.
 *
 * @property int $id
 * @property string $name
 * @property string $avatar_url
 * @property string $class
 * @property string $joined_date
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Position[] $positions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Team[] $teams
 * @property-read User $user
 * @method static Builder|Member whereId($value)
 * @method static Builder|Member whereName($value)
 * @method static Builder|Member whereAvatarUrl($value)
 * @method static Builder|Member whereClass($value)
 * @method static Builder|Member whereJoinedDate($value)
 * @method static Builder|Member whereUserId($value)
 * @mixin \Eloquent
 */
class Member extends Model
{


    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'members';


    /**
     * position.
     *
     * @return  BelongsToMany;
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position', 'members_positions');
    }

    /**
     * Assign a position.
     *
     * @param Position $position
     */
    public function assignPosition($position)
    {
        $this->positions()->attach($position);
    }

    /**
     * Remove a position.
     *
     * @param Position $position
     * @return int
     */
    public function removePosition($position)
    {
        return $this->positions()->detach($position);
    }

    /**
     * @return BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany('App\Team', 'members_teams');
    }

    /**
     * @param Team $team
     */
    public function assignTeam($team)
    {
        $this->teams()->attach($team);
    }

    /**
     * @param Team $team
     * @return int
     */
    public function removeTeam($team)
    {
        return $this->teams()->detach($team);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @param User $user
     * @return User
     */
    public function assignUser($user)
    {
        /**
         * @var User $model
         */
        $model = $this->user()->associate($user);
        return $model;
    }

    /**
     * @return User
     */
    public function removeUser()
    {
        /**
         * @var User $model
         */
        $model = $this->user()->dissociate();
        return $model;
    }
}
