<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Member
 *
 * @property int $id
 * @property string $name
 * @property string $birthday
 * @property string $class
 * @property bool $gender
 * @property string $highest_position
 * @property string $phone
 * @property string $email
 * @property string $specialize
 * @property int $team_id
 * @property-read \App\Models\Team $teams
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereHighestPosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereSpecialize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Member whereTeamId($value)
 * @mixin \Eloquent
 */
class Member extends Model
{
    const GENDER_MALE = false;
    const GENDER_FEMALE = true;

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'members';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teams()
    {
        return $this->belongsTo('App\Models\Team');
    }

    /**
     * @param Team $team
     */
    public function assignTeam($team)
    {
        $this->teams()->associate($team);
    }

    /**
     * @return Team
     */
    public function removeTeam()
    {
        /**
         * @var Team $model
         */
        $model = $this->teams()->dissociate();
        return $model;
    }
}
