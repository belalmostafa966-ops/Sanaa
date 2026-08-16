<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
       
        'name',
        'email',
        'password',
        'role',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
   protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // الطلبات اللي العميل ده طلبها
    public function jobRequests()
    {
        return $this->hasMany(JobRequest::class, 'client_id');
    }

    // الطلبات اللي الصنايعي ده متكلف بيها
    public function assignedJobs()
    {
        return $this->hasMany(JobRequest::class, 'assigned_worker_id');
    }

    // عروض الأسعار اللي الصنايعي بعتها
    public function offers()
    {
        return $this->hasMany(Offer::class, 'worker_id');
    }

    // شغل البورتفوليو بتاع الصنايعي
    public function portfolioItems()
    {
        return $this->hasMany(PortfolioItem::class, 'worker_id');
    }

    // التقييمات اللي العميل ده كتبها
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    // التقييمات اللي الصنايعي ده اتقيّم بيها
    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'worker_id');
    }

}
