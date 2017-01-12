<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Team.
 *
 * @author  The scaffold-interface created at 2017-01-11 04:49:31pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Team extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'teams';

	
}
