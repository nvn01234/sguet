<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Laravel\Scout\Searchable;

/**
 * Class Article.
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $image_url
 * @property string $short_description
 * @property integer $category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @property-read \App\Category $category
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereBody($value)
 * @method static Builder|Article whereImageUrl($value)
 * @method static Builder|Article whereShortDescription($value)
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{
    use  Searchable;

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
