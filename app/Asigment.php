<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asigment extends Model
{
    public $guarded = ['id', 'created_at', 'updated_at'];

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
}
