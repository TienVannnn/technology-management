<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyRequest extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'sr_id'
    ];

    public function support_request()
    {
        return $this->belongsTo(SupportRequest::class, 'sr_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
