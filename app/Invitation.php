<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'asigment_id', 'teacher_id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function asigment()
    {
        return $this->belongsTo(Asigment::class)->with('level', 'category');
    }
}
