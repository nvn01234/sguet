<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property string $name
 * @property int $_lft
 * @property int $_rgt
 * @property int $parent_id
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Department[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Human[] $humans
 * @property-read \App\Models\Department $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department d()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Department whereRgt($value)
 * @mixin \Eloquent
 */
class Department extends Model
{
    use NodeTrait;

    public $timestamps = false;
    protected $guarded = [];

    public function humans() {
        return $this->belongsToMany(Human::class, 'humans_departments')->withPivot('position');
    }
}
