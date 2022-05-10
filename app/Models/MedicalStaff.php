<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'specialisation', 'department_id', 'user_id', 'specialisation_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

    public function availableTimeslot(){
        return $this->hasMany(AvailableTimeslot::class);
    }

    public function specialisation(){
        return $this->belongsTo(Specialisation::class);
    }

    public function referrals(){
        return $this->hasMany(Referral::class);
    }
}
