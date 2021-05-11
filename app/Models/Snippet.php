<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;

class Snippet extends Model
{
    use HasFactory, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'markdown',
    ];

    /**
     * Options for generating a slug for this model.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(40);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scoped Query to include streetcred for the snippet:
     * Snippet::withStreetcred->get()
     * @param Builder $query
     */
    public function scopeWithStreetcred(Builder $query)
    {
        $query->leftJoinSub(
            'SELECT snippet_id, SUM(streetcred) streetcred from streetcreds GROUP BY snippet_id',
            'streetcreds',
            'streetcreds.snippet_id', 'snippets.id'
        );
    }

    /**
     * Add streetcred to a snippet from user
     */
    public function giveStreetcred()
    {
        $this->streetcred()->updateOrCreate([
            'user_id' => auth()->id(),
        ], [
            'streetcred' => 1
        ]);
    }

    /**
     * Remove streetcred from a snippet from user
     */
    public function removeStreetcred()
    {
        $this->streetcred()->where(
            'user_id', auth()->id()
        )->delete();
    }

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if a user gave a specific snippet some streetcred
     * @param User $user
     * @return bool
     */
    public function gotStreetcredFrom(User $user)
    {
        return (bool)$user->streetcred
            ->where('snippet_id', $this->id)
            ->where('streetcred', 1)
            ->count();
    }

    /**
     * Get the user who gave streetcred to snippet.
     */
    public function streetcred()
    {
        return $this->hasMany(StreetCred::class);
    }
}
