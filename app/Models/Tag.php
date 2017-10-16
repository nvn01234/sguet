<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $faqs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Taggable[] $taggable
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereSlug($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $hidden = ['pivot'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_tag');
    }

    /**
     * @param Article $article
     */
    public function assignArticle($article)
    {
        $this->articles()->attach($article);
    }

    /**
     * @param Article $article
     * @return int
     */
    public function removeArticle($article)
    {
        return $this->articles()->detach($article);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function faqs()
    {
        return $this->belongsToMany('App\Models\Faq', 'faq_tag');
    }

    /**
     * @param Faq $faq
     */
    public function assignFaq($faq)
    {
        $this->faqs()->attach($faq);
    }

    /**
     * @param Faq $faq
     * @return int
     */
    public function removeFaq($faq)
    {
        return $this->faqs()->detach($faq);
    }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taggable() {
        return $this->belongsToMany(Taggable::class, 'taggable_tag');
    }
}
