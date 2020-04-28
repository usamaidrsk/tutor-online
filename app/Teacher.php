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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPhoneAttribute()
    {
        $phone = $this->attributes['phone'];

        if ($phone) {
            $phone = PhoneNumber::make($phone);
            $phone = $phone->formatInternational();
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
