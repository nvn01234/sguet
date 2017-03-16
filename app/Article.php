<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Laravel\Scout\Searchable;

/**
 * App\Article
 *
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string $body
 * @property string $image_url
 * @property int $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereShortDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    protected $fillable = ['id', 'title', 'short_description', 'body', 'category_id', 'image_url', 'created_at', 'updated_at'];

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * @param Tag $tag
     */
    public function assignTag($tag)
    {
        $this->tags()->attach($tag);
    }

    /**
     * @param Tag|array $tag
     * @return int
     */
    public function removeTag($tag = [])
    {
        return $this->tags()->detach($tag);
    }

    /**
     * @param Collection|array $tags
     * @return array
     */
    public function syncTags($tags) {
        return $this->tags()->sync($tags);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @param Category $category
     * @return Category
     */
    public function assignCategory($category)
    {
        /**
         * @var Category $model
         */
        $model = $this->category()->associate($category);
        return $model;
    }

    /**
     * @return Category
     */
    public function removeCategory()
    {
        /**
         * @var Category $model
         */
        $model = $this->category()->dissociate();
        return $model;
    }
}
