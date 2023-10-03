<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorDetailLink extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'doctor_id', 'education', 'specialist_id', 'department_id', 'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function specialist()
    {
        return $this->hasOne(Specialist::class,'id','specialist_id');
    }
}
