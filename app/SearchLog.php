<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SearchLog
 *
 * @property int $id
 * @property string $text
 * @property int $search_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $results
 * @method static \Illuminate\Database\Query\Builder|\App\SearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchLog whereSearchCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchLog whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SearchLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SearchLog extends Model
{
    protected $table = 'search_logs';
    protected $fillable = ['text', 'search_count'];

    public function results() {
        return $this->belongsToMany('App\Faq', 'search_results');
    }

    public function syncResults($ids) {
        return $this->results()->sync($ids);
    }
}
