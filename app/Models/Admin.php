<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions; // Import this class

class Admin extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $guarded = [];


    public function doctor(){
        return $this->hasOne(Doctor::class,'admin_id','id');
    }
    // protected static $logAttributes = [
    //     'name',
    //     'email',
    //     'last_login_at',
    // ];

    // protected static $logName = 'admin';

    // public function getDescriptionForEvent(string $eventName): string
    // {
    //     return "Admin model has been {$eventName}";
    // }

    // // Implement the getActivitylogOptions method
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logAll()
    //         ->useLogName(self::$logName);
    // }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;


        if ($this->is_super) {
            return true;
        }

        if (!$role) {
            return false;
        }
        foreach ($role->permissions as $permission) {

            if (is_array($permissions) && in_array($permission, $permissions)) {

                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }

        return false;
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function getAttachment()
    {
        return $this->photo ? asset(  'storage/'.$this->photo) : asset('assets/logo.png');
    }


  public function receivesBroadcastNotificationsOn(): string
{
    return 'doctor.' . $this->id;
}
}
