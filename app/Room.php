<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['token', 'asigment_id', 'teacher_id'];

    public function asigment()
    {
        return $this->belongsTo(Asigment::class)->with('level', 'category');
    }
}
