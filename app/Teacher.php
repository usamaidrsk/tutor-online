<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Propaganistas\LaravelPhone\PhoneNumber;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'birthday',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'birthday' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function getPhoneAttribute()
    {
        if ($phone = $this->attributes['phone']) {
            $phone = PhoneNumber::make($phone);
            return $phone->formatInternational();
        }

        return $phone;
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
}
