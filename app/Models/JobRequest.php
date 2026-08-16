<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'category_id',
        'title',
        'description',
        'area',
        'status',
        'assigned_worker_id',
    ];

    // العميل صاحب الطلب
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // التصنيف (سباكة، كهرباء...)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // الصنايعي اللي اتقبل عليه الطلب
    public function assignedWorker()
    {
        return $this->belongsTo(User::class, 'assigned_worker_id');
    }

    // كل عروض الأسعار اللي جت على الطلب ده
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    // التقييم بتاع الطلب ده (لو خلص وحد قيّمه)
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
