<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Member.
 *
 * @property integer $id
 * @property string $name
 * @property Carbon $birthday
 * @property string $class
 * @property boolean $gender
 * @property string $highest_position
 * @property string $phone
 * @property string $email
 * @property string $specialize
 * @property integer $team_id
 * @property-read \App\Team $teams
 * @method static Builder|Member whereId($value)
 * @method static Builder|Member whereName($value)
 * @method static Builder|Member whereBirthday($value)
 * @method static Builder|Member whereClass($value)
 * @method static Builder|Member whereGender($value)
 * @method static Builder|Member whereHighestPosition($value)
 * @method static Builder|Member wherePhone($value)
 * @method static Builder|Member whereEmail($value)
 * @method static Builder|Member whereSpecialize($value)
 * @method static Builder|Member whereTeamId($value)
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
