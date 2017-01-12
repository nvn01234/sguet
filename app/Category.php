<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Category.
 *
 * @author  The scaffold-interface created at 2017-01-12 04:59:16pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Category extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'categories';

	
}
