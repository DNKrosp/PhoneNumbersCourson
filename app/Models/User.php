<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function numbers(): HasMany
    {
        return $this->hasMany(Number::class);
    }

    public static function createNewUser($login, $password, $email): ?User
    {
        try {
            $user = new User();
            $user->login = $login;
            $user->email = $email;

            $salt = md5(random_bytes(16));
            $password = hash("sha256", $password.$salt);

            $user->password = $password;
            $user->salt = $salt;
            $user->save();
            return $user;
        } catch (Exception $e) {
            //todo: logs and humanny errors
        }
        return null;
    }

}
