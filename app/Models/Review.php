<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'client_id',
        'worker_id',
        'rating',
        'comment',
    ];

    // الطلب اللي التقييم ده عليه
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }

    // العميل اللي كتب التقييم
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // الصنايعي اللي اتقيّم
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}