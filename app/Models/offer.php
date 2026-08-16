<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'worker_id',
        'price',
        'message',
        'status',
    ];

    // الطلب اللي العرض ده رد عليه
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }

    // الصنايعي اللي بعت العرض
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}