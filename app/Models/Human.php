<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Human
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $academic_title
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Department[] $departments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Human whereAcademicTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Human whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Human whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Human whereLastName($value)
 * @mixin \Eloquent
 */
class Human extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments() {
        return $this->belongsToMany(Department::class, 'humans_departments')->withPivot('position');
    }
}
