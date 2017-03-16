<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * App\Member
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
 * @property-read \App\Team $teams
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereHighestPosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereSpecialize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Member whereTeamId($value)
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

    protected $fillable = ['name', 'birthday', 'class', 'gender', 'highest_position', 'phone', 'email', 'specialize', 'team_id'];

    /**
     * @var string
     */
    protected $table = 'members';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teams()
    {
        return $this->belongsTo('App\Team');
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
