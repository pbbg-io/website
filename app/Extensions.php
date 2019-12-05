<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Extensions extends Model
{
    use
        Searchable,
        HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['author_name', 'name'])
            ->saveSlugsTo('slug');
    }

    public function getAuthorNameAttribute() {
        return $this->authorMeta->name;
    }

    public function authorMeta() {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
