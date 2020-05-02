<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asigment extends Model
{
    public $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['total_files'];

    public function getCreatedAtAttribute()
    {
        $date = $this->attributes['created_at'];
        return Carbon::create($date)->isoFormat('D \d\e MMMM, YYYY');
    }

    public function getTotalFilesAttribute()
    {
        return $this->files->count();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
