<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospitalName', 'address', 'streetName', 'city', 'postalCode',
    ];

    public function referral(){
        return $this->hasMany(Referral::class);
    }
}
