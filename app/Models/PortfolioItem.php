<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'title',
        'description',
        'image_path',
    ];

    // الصنايعي صاحب شغلانة البورتفوليو دي
    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
}