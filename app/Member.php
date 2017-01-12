<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Member.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:48:18pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Member extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'members';

	

	/**
     * position.
     *
     * @return  \Illuminate\Support\Collection;
     */
    public function positions()
    {
        return $this->belongsToMany('App\Position');
    }

    /**
     * Assign a position.
     *
     * @param  $position
     * @return  mixed
     */
    public function assignPosition($position)
    {
        return $this->positions()->attach($position);
    }
    /**
     * Remove a position.
     *
     * @param  $position
     * @return  mixed
     */
    public function removePosition($position)
    {
        return $this->positions()->detach($position);
    }

}
