<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted() {

        /**
         * 
         * @return boolean true if user is in the same board the photo belongs to. 
         */
        // Si on renvoi faux dans cette fonction, la création n'est pas effectuée, sinon elle est effectuée
        static::creating(function ($photo) {
            return !is_null($photo->group->users->find($photo->user_id));
        });
    }
    
     
      /**
     * Renvoi les commentaires à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }


     /**
     * Renvoi les groupes à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group() {
        return $this->BelongsTo(Group::class);
    }

    /**
     * Renvoi les utilisateurs à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Renvoi les utilisateurs à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users() {
        return $this->BelongsToMany(User::class)
                    ->using(PhotoUser::class)
                    ->withPivot("id")
                    ->withTimestamps();
    }

    /**
     * Renvoi les tags à laquelle est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags() {
        return $this->BelongsToMany(Tag::class)
                    ->using(PhotoTag::class)
                    ->withPivot("id")
                    ->withTimestamps();
    }


}