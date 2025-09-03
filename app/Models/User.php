<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'mobile',
        'id_number',
        'photo',
        'gender_cd_id',
        'fcm_token',
        'provider_id',
        'provider_name',
        'code',
        'lang'


    ];

    public function genderCd(){
        return $this->belongsTo(Constant::class,'gender_cd_id','id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getPhotoAttribute($value)
    {

        if ($value) {
            return asset('storage/' . $value);
        }

        return asset('assets/default.png');
    }


      public function medicalTestUsers()
    {
        return $this->hasMany(MedicalTestUser::class, 'user_id', 'id');
    }
     public function surgicalOperations()
    {
        return $this->hasMany(SurgicalOperation::class, 'user_id', 'id');
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id', 'id');
    }

    public function appointmentCount()
    {
        return $this->appointments()->count();
    }

     public function lastAppointment()
    {
        $appointments= $this->appointments()->orderby('id','desc')->first();

        return $appointments?->date;
    }


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
