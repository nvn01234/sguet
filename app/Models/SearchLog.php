<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SearchLog
 *
 * @property int $id
 * @property string $text
 * @property string $ip
 * @property int $faqs_count
 * @property int $contacts_count
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereContactsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereFaqsCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SearchLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SearchLog extends Model
{
    use SoftDeletes;

    protected $table = 'search_logs';
    protected $guarded = [];
}
