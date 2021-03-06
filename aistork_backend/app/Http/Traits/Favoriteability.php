<?php

namespace App\Http\Traits;

use App\Models\Favorite;

trait Favoriteability {
    /**
     * Define a one-to-many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }

    /**
     * Return a collection with the User favorited Model.
     * The Model needs to have the Favoriteable trait
     * 
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return Collection
     */
    public function favorite($class, $type = null)
    {
        return $this->favorites()->where('favoriteable_type', $class)->with('favoriteable')->get()->mapWithKeys(function ($item) use ($type){
            if (isset($item['favoriteable']) && ($type ? $item['favoriteable']->type == $type : true)) {
                return [$item['favoriteable']->id=>$item['favoriteable']];
            }

            return [];
        });
    }

    /**
     * Add the object to the User favorites.
     * The Model needs to have the Favoriteable trai
     * 
     * @param Object $object
     */
    public function addFavorite($object)
    {
        $object->addFavorite($this->id);
    }

    /**
     * Remove the Object from the user favorites.
     * The Model needs to have the Favoriteable trai
     * 
     * @param Object $object
     */
    public function removeFavorite($object)
    {
        $object->removeFavorite($this->id);
    }

    /**
     * Toggle the favorite status from this Object from the user favorites.
     * The Model needs to have the Favoriteable trai
     * 
     * @param Object $object
     */
    public function toggleFavorite($object)
    {
        $object->toggleFavorite($this->id);
    }

    /**
     * Check if the user has favorited this Object
     * The Model needs to have the Favoriteable trai
     * 
     * @param Object $object
     * @return boolean
     */
    public function isFavorited($object)
    {
        return $object->isFavorited($this->id);
    }

    /**
     * Check if the user has favorited this Object
     * The Model needs to have the Favoriteable trai
     * 
     * @param Object $object
     * @return boolean
     */
    public function hasFavorited($object)
    {
        return $object->isFavorited($this->id);
    }
}

