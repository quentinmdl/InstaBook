<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PhotoTag extends Pivot
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
     * Renvoi l'utilisateur lié au groupe
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function tags()
    {
        return $this->hasMany(Photo::class);
    }


     /**
     * Renvoi le groupe lié à l'utilisateur
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

}
