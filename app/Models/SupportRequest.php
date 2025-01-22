<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $casts = [
        'reception_time' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'title',
        'support_request',
        'customer_id',
        'department_id',
        'status',
        'is_new',
        'reception_time'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reply_requests()
    {
        return $this->hasMany(ReplyRequest::class, 'sr_id');
    }
}
