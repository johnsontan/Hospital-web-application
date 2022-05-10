<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'grandTotal', 'status', 'paymentType', 'patient_id', 'appointment_id'
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
?>