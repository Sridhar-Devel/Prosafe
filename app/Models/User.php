<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];

    /**
     * Finds and returns valid auth doamin
     *
     * @param  string  $user_email
     * @return bool
     */
    public static function isValidDomain($user_email)
    {
        $google_login_domain = env('GOOGLE_LOGIN_DOMAIN', null);

        return Str::endsWith($user_email, $google_login_domain);
    }

    /**
     * Finds and returns valid user role
     *
     * @param  mixed  $user
     * @return void
     */
    public static function attachRole($user)
    {
        $role_name = env('USER_DEFAULT_ROLE', null);

        $role = Role::where('name', '=', $role_name)->firstOrFail();

        // attach role if not already present
        if (! $user->hasRole($role->name)) {
            $user->roles()->attach($role->id);
        }

    }
}
