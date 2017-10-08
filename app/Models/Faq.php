<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Models\Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $paraphrases
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereAnswer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereParaphrases($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereQuestion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faq extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use ElasticTrait {
        toElasticData as toElasticDataTrait;
    }

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string
     */
    protected $table = 'faqs';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
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
     * @param Collection|Tag[] $tags
     * @return array
     */
    public function syncTags($tags)
    {
        return $this->tags()->sync($tags);
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
                'source' => 'question'
            ]
        ];
    }

    public function toElasticData()
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'paraphrase' => $this->paraphrases ? explode(',', $this->paraphrases) : [],
            'tags' => $this->tags->pluck('name')->toArray()
        ];
    }
}
