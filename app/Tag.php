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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany('App\Article', 'articles_tags');
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
}
