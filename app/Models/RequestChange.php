<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestChange extends Model
{
    protected $tables =  'request_changes';
    protected $fillable = [
        'request_id',
        'changed_by',
        'field_name',
        'old_value',
        'new_value'
    ];

    public function changedby()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    public function request()
    {
        return $this->belongsTo(SupportRequest::class, 'request_id');
    }
}
