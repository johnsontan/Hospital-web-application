<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableTimeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'availDate', 'blockNumber', 'status', 'medical_staff_id'
    ];

    public function medicalStaff(){
        return $this->belongsTo(MedicalStaff::class);
    }
}
