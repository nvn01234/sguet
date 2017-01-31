<?php

namespace App;

use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Laravel\Scout\Searchable;

/**
 * Class Article.
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static Builder|Article whereId($value)
 * @method static Builder|Article whereQuestion($value)
 * @method static Builder|Article whereAnswer($value)
 * @method static Builder|Article whereCreatedAt($value)
 * @method static Builder|Article whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Faq extends Model
{
    use Searchable;

    /**
     * @var array
     */
    protected $fillable = ['id', 'question', 'answer', 'created_at', 'updated_at'];

    /**
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [];

        $array['question'] = $this->question;

        $array['tags'] = $this->tags()->get(['name']);

        $body = strip_tags($this->answer);
        $a = ["\t", "\n", "\r", "&nbsp;"];
        $body = str_replace($a, " ", $body);
        $body = preg_replace('# {2,}#', ' ', $body);
        $body = trim($body);
        $array['answer'] = $body;

        return $array;
    }

//    use AlgoliaEloquentTrait;
//
//    public function getAlgoliaRecord()
//    {
//        return $this->toSearchableArray();
//    }
//
//    public static $autoIndex = false;
//    public static $autoDelete = false;
//    public static $objectIdKey = 'objectId';
//    public $indices = 'sguet_faqs';
//
//    public $algoliaSettings = [
//        'searchableAttributes' => [
//            'question',
//            'tags.name',
//            'answer',
//        ],
//        'customRanking' => [
//            'asc(question)',
//            'desc(tags)',
//            'asc(tags.name)',
//            'asc(answer)',
//        ]
//    ];

    /**
     * @var string
     */
    protected $table = 'faqs';

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
     * @param Collection|Tag[] $tags
     * @return array
     */
    public function syncTags($tags)
    {
        return $this->tags()->sync($tags);
    }
}
