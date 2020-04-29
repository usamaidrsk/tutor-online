<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['status', 'asigment_id', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function asigment()
    {
        return $this->belongsTo(Asigment::class)->with('level', 'category');
    }
}
