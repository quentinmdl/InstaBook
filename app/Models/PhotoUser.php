<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoUser extends Pivot
{
    use HasFactory;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @see https://laravel.com/docs/8.x/eloquent-relationships#defining-custom-intermediate-table-models
     * @var bool
     */
    public $incrementing = true;


    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted() {

        /**
         * 
         * @return boolean true if user is in the same group the photo belongs to. 
         */
        // Si on renvoi faux dans cette fonction, la création n'est pas effectuée, sinon elle est effectuée
        static::creating(function ($photo_user) {
            return !is_null($photo_user->photo->group->users->find($photo_user->user_id));
        });
    }






    /**
     * Renvoi l'utilisateur lié au groupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function user()
    {
        return $this->BelongsTo(User::class);
    }


     /**
     * Renvoi le groupe lié à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function photo()
    {
        return $this->BelongsTo(Photo::class);
    }

   
}
