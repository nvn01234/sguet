<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Contact
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $phone_cq
 * @property string $phone_nr
 * @property string $phone_dd
 * @property string $fax
 * @property string $email
 * @property int $_lft
 * @property int $_rgt
 * @property int $parent_id
 * @property-read \Kalnoy\Nestedset\Collection|\App\Contact[] $children
 * @property-read \App\Contact $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Contact d()
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePhoneCq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePhoneDd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact wherePhoneNr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Contact whereRgt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use NodeTrait;
    protected $table = 'contacts';
    protected $fillable = ['name', 'description' ,'phone_cq', 'phone_nr', 'phone_dd', 'fax', 'email', 'parent_id'];
    public $timestamps = false;
}
