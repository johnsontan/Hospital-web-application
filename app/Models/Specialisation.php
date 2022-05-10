<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialisation', 'department_id'
    ];

    public function treatment(){
        return $this->hasOne(Treatments::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function medicalStaff(){
        return $this->hasMany(MedicalStaff::class);
    }
}
