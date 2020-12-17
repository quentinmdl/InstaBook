<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    /**
     * Renvoi les photos aux quelles est associé la photo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos() {
        return $this->BelongsToMany(Photo::class)
                    ->using(PhotoTag::class)
                    ->withPivot("id")
                    ->withTimestamps();
    }
}
