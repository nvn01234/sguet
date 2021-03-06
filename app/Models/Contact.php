<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Contact
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
 * @property string $slug
 * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Contact[] $children
 * @property-read \App\Models\Contact $parent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact d()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact wherePhoneCq($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact wherePhoneDd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact wherePhoneNr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Contact whereSlug($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use NodeTrait;
    use ElasticTrait;

    protected $table = 'contacts';
    protected $guarded = [];
    public $timestamps = false;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function jstreeData() {
        return [
            'id' => "$this->id",
            'parent' => $this->parent_id ? "$this->parent_id" : "#",
            'text' => $this->getNameWithDescription(),
            'state' => [
                'opened' => true,
            ],
            'children' => $this->children->isNotEmpty(),
            'a_attr' => [
                'href' => 'javascript:'
            ]
        ];
    }

    public function getNameWithDescription() {
        return $this->description ? "$this->name ($this->description)" : $this->name;
    }

    public function getOgDescription() {
        $array = [$this->getNameWithDescription()];
        if ($this->phone_nr) $array[] = "NR: $this->phone_nr";
        if ($this->phone_cq) $array[] = "CQ: $this->phone_cq";
        if ($this->phone_dd) $array[] = "DĐ: $this->phone_dd";
        if ($this->fax) $array[] = "Fax: $this->fax";
        if ($this->email) $array[] = "Email: $this->email";
        return implode(", ", $array);
    }
}
