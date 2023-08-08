<?php

namespace App;

use App\Models\Doctor;
use App\Models\Earning;
use App\Models\Models\Appointment;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function get_roles()
    {
        $roles = [];
        foreach ($this->getRoleNames() as $key => $role) {
            $roles[$key] = $role;
        }

        return $roles;
    }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->update(['slug' => $user->name]);
        });
    }

    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = Str::slug($value))->exists()) {
            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }

    /**
     * Increment slug
     *
     * @param   string $slug
     * @return  string
     **/
    public function incrementSlug($slug)
    {
        // get the slug of the latest created post
        $max = static::whereName($this->name)->latest('id')->skip(1)->value('slug');

        if (is_numeric($max[-1])) {
            return preg_replace_callback('/(\d+)$/', function ($mathces) {
                return $mathces[1] + 1;
            }, $max);
        }

        return "{$slug}-2";
    }

    // public function age()
    // {
    //     return Carbon::parse($this->attributes['birthdate'])->age;
    // }

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'user_id', 'id');
    }

    public function parent_doctor()
    {
        return $this->hasOne(User::class, 'doctor_id', 'id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescription()
    {
        return $this->hasMany('App\Models\Prescription', 'patient_id', 'id');
    }

    public function earning()
    {
        return $this->hasMany(Earning::class, 'user_id', 'id');
    }

}
