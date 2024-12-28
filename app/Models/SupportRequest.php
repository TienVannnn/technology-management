<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $casts = [
        'reception_time' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'support_request',
        'customer_id',
        'department_id',
        'status',
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
}
