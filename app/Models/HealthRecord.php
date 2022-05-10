<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id'
    ];

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function testResult(){
        return $this->hasMany(TestResult::class);
    }

    public function prescription(){
        return $this->hasMany(Prescription::class);
    }

    public function eMedicalCert(){
        return $this->hasMany(EMedicalCert::class);
    }
}
