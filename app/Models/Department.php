<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'departmentName', 
    ];

    public function medicalStaff(){
        return $this->hasMany(MedicalStaff::class);
    }

    public function treatment(){
        return $this->hasMany(Treatment::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }
    
    public function specialisation(){
        return $this->hasMany(Specialisation::class);
    }
}
