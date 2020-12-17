<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     /**
     * Renvoi les commentaires à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Renvoi les photos à laquelle est associé l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function photos() {
        return $this->hasMany(Photo::class);
    }

    /**
     * Renvoi les groupes à laquelle est associé l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups() {

        return $this->BelongsToMany(Group::class)
                    ->using(GroupUser::class)
                    ->withPivot("id")
                    ->withTimestamps();
    }



    /**
     * Renvoi les photos aux quelles l'utilisateur est associée
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photosAppearance() {
        return $this->BelongsToMany(Photo::class)
                    ->using(PhotoUser::class)
                    ->withPivot("id")
                    ->withTimestamps();
    }

}