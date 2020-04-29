<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Propaganistas\LaravelPhone\PhoneNumber;
use Carbon\Carbon;

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

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getBirthdayAttribute()
    {
        $date = $this->attributes['birthday'];
        return Carbon::create($date)->isoFormat('D \d\e MMMM, YYYY');
    }

    public function getPhoneAttribute()
    {
        if ($phone = $this->attributes['phone']) {
            try {
                $phone = PhoneNumber::make($phone)->formatInternational();
            } catch (\Throwable $th) {
                report($th);
            }
        }

        return $phone;
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
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
