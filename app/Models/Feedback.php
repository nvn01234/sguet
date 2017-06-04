<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property string $ip
 * @property int $type
 * @property int $status
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Feedback whereUserId($value)
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    const STATUS = [
        0 => 'Chưa xử lý',
        10 => 'Đang xử lý',
        100 => 'Đã xử lý',
    ];

    const STATUS_LABEL = [
        0 => 'default',
        10 => 'info',
        100 => 'success',
    ];

    const TYPE = [
        'Liên hệ',
        'Góp ý',
        'Câu hỏi',
        'Lỗi nội dung',
        'Lỗi hệ thống',
        'Nhận xét',
        'Khác',
    ];

    const TYPE_LABEL = [
        'primary',
        'info',
        'primary',
        'warning',
        'danger',
        'info',
        'default',
    ];

    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'feedbacks';

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
