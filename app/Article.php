<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Article.
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $image_url
 * @property string $short_description
 * @property int $author_id
 * @property int $last_modifier_id
 * @property int $category_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $author
 * @property-read User $last_modifier
 * @property-read Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereTitle($value)
 * @method static Builder|Article whereBody($value)
 * @method static Builder|Article whereImageUrl($value)
 * @method static Builder|Article whereShortDescription($value)
 * @method static Builder|Article whereAuthorId($value)
 * @method static Builder|Article whereLastModifierId($value)
 * @method static Builder|Article whereCategoryId($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Article extends Model
{


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
     * @param Tag $tag
     * @return int
     */
    public function removeTag($tag)
    {
        return $this->tags()->detach($tag);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /**
     * @param User $user
     * @return User
     */
    public function assignAuthor($user)
    {
        /**
         * @var User $model
         */
        $model = $this->author()->associate($user);
        return $model;
    }

    /**
     * @return User
     */
    public function removeAuthor()
    {
        /**
         * @var User $model
         */
        $model = $this->author()->dissociate();
        return $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function last_modifier()
    {
        return $this->belongsTo('App\User', 'last_modifier_id');
    }

    /**
     * @param User $user
     * @return User
     */
    public function assignLastModifier($user)
    {
        /**
         * @var User $model
         */
        $model = $this->last_modifier()->associate($user);
        return $model;
    }

    /**
     * @return User
     */
    public function removeLastModifier()
    {
        /**
         * @var User $model
         */
        $model = $this->last_modifier()->dissociate();
        return $model;
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
