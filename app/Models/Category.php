<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    // كل الطلبات اللي تحت التصنيف ده
    public function jobRequests()
    {
        return $this->hasMany(JobRequest::class);
    }
}
