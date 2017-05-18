<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $faqs
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Tag whereName($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
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
}
