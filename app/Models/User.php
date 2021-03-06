<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected function defaultProfilePhotoUrl()
    {
        return 'https://avatars.dicebear.com/api/bottts/' . urlencode($this->name) . '.svg?background=%2394A3B8';
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the snippets for the user.
     */
    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }

    /**
     * Get the snippets the user gave streetcred for.
     */
    public function gaveStreetcred()
    {
        return $this->hasMany(Streetcred::class);
    }

    /**
     * Make sure the user's streetcred aligns with
     * the streetcred from the snippets.
     */
    public function syncStreetcred()
    {
        $this->streetcred = $this->snippets()->get()->sum('streetcred_count');
        $this->save();
    }

}
