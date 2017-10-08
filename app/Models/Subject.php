<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $name_en
 * @property int $credits
 * @property int $theory_credit_hours
 * @property int $practice_credit_hours
 * @property int $self_study_credit_hours
 * @property string $pre_subject_code
 * @property string $abstract
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereAbstract($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereCredits($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereNameEn($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject wherePracticeCreditHours($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject wherePreSubjectCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereSelfStudyCreditHours($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Subject whereTheoryCreditHours($value)
 * @mixin \Eloquent
 */
class Subject extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function toElasticData() {
        return $this->toArray();
    }
}
