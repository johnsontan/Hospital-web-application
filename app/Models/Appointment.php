<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appDate', 'appTime', 'status', 'medical_staff_id', 'treatment_id', 'department_id', 'patient_id', 'memo'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medicalStaff(){
        return $this->belongsTo(MedicalStaff::class);
    }

    public function treatment(){
        return $this->belongsTo(Treatments::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function healthRecord(){
        return $this->hasMany(HealthRecord::class);
    }

    public function feedback(){
        return $this->hasOne(Feedback::class);
    }

    public function paymentRecord(){
        return $this->hasOne(PaymentRecords::class);
    }
    
    public function referral(){
        return $this->hasOne(Referral::class);
    }

}
