<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SearchLog
 *
 * @property int $id
 * @property string $text
 * @property int $search_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $results
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereSearchCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SearchLog extends Model
{
    protected $table = 'search_logs';
    protected $guarded = [];

    public function results() {
        return $this->belongsToMany('App\Models\Faq', 'search_results');
    }

    public function syncResults($ids) {
        return $this->results()->sync($ids);
    }
}
