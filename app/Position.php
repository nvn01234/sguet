<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Position.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:50:00pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Position extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'positions';

	

	/**
     * member.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function members()
    {
        return $this->belongsToMany('App\Member');
    }

    /**
     * Assign a member.
     *
     * @param  $member
     * @return  mixed
     */
    public function assignMember($member)
    {
        return $this->members()->attach($member);
    }
    /**
     * Remove a member.
     *
     * @param  $member
     * @return  mixed
     */
    public function removeMember($member)
    {
        return $this->members()->detach($member);
    }

}
