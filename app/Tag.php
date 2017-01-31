<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class Tag.
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Faq[] $faqs
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
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

    protected $fillable = ['name'];

    protected $hidden = ['pivot'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article');
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
        return $this->belongsToMany('App\Faq');
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
