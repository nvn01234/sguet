<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag.
 *
 * @author  The scaffold-interface created at 2017-01-11 05:19:58pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Tag extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'tags';

	
}
