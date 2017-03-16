<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Query\Builder;

/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    const NAME_NEWS = 'Tin tức';
    const NAME_ACTIVITIES = 'Hoạt động';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'categories';

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
}
