<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'promoDesc', 
    ];

    public function showRecipients(){
        return $this->belongsToMany(User::class);
    }
}
