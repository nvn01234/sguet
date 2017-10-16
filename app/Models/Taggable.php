<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Taggable
 *
 * @property int $id
 * @property-read \App\Models\Article $article
 * @property-read \App\Models\Faq $faq
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Taggable whereId($value)
 * @mixin \Eloquent
 */
class Taggable extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(Tag::class, 'taggable_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function faq() {
        return $this->hasOne(Faq::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function article() {
        return $this->hasOne(Article::class);
    }
}
