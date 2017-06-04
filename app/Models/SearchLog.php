<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SearchLog
 *
 * @property int $id
 * @property string $text
 * @property int $search_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $ip
 * @property int $user_id
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faq[] $results
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereSearchCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereUserId($value)
 * @mixin \Eloquent
 */
class SearchLog extends Model
{
    use SoftDeletes;

    protected $table = 'search_logs';
    protected $guarded = [];

    public function results() {
        return $this->belongsToMany('App\Models\Faq', 'search_results');
    }

    public function syncResults($ids) {
        return $this->results()->sync($ids);
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
