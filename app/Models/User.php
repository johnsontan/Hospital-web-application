<?php

namespace App\Models;

use App\Mail\NewUserWelcome;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    protected static function boot(){
        parent::boot();
        static::created(function ($user){
            $user->profile()->create([
                'gender' => request()->gender,
                'phoneNumber' => request()->phoneNumber,
                'DOB' => request()->dob,
                'age' => request()->age,
                'name' => request()->name,
            ]);
                    
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function confirmTwoFactorAuth($code)
    {
        $codeIsValid = app(TwoFactorAuthenticationProvider::class)
            ->verify(decrypt($this->two_factor_secret), $code);

        if ($codeIsValid) {
            $this->two_factor_confirmed = true;
            $this->save();

            return true;
        }

        return false;
    }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function medicalStaff(){
        return $this->hasOne(MedicalStaff::class);
    }

    public function showPromos(){
        return $this->belongsToMany(PromotionalMessage::class);
    }
}
