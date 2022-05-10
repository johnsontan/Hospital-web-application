<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;
    protected $fillable = [
        'referralDate', 'referralTime', 'medical_staff_id', 'location_id','status','requestedTime'
    ];

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function location(){
        return $this->belongsTo(Location::class);
    }
    
    public function medicalStaff(){
        return $this->belongsTo(MedicalStaff::class);
    }
}
