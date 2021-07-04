<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
trait Streetcredable
{

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
     * Determine if the user gave the snippet streetcred.
     *
     * @return bool
     */
    public function getGaveStreetcredAttribute(): bool
    {
        if ($user = auth()->user()) {
            return (bool)$this->streetcred()
                ->firstWhere('user_id', $user->id);
        }

        return false;
    }

    /**
     * Determine if the user gave the snippet streetcred.
     *
     * @return bool
     */
    public function getStreetcredCountAttribute()
    {
        return $this->streetcred()->count();
    }

    /**
     * Add streetcred to a snippet from user
     */
    public function giveStreetcred()
    {
        $this->streetcred()->updateOrCreate([
            'user_id' => auth()->id(),
            'streetcred' => 1
        ]);

        // Force persist the changes to the search index:
        // https://laravel.com/docs/8.x/scout#updating-records
        $this->save();

        // We also need to update the user's streetcred
        $this->user()->increment('streetcred');
    }

    /**
     * Remove streetcred from a snippet from user
     */
    public function removeStreetcred()
    {
        $this->streetcred()->where(
            'user_id', auth()->id()
        )->delete();

        // Force persist the changes to the search index:
        // https://laravel.com/docs/8.x/scout#updating-records
        $this->save();

        // We also need to update the user's streetcred
        $this->user()->decrement('streetcred');
    }

    /**
     * Get the user who gave streetcred to snippet.
     */
    public function streetcred()
    {
        return $this->hasMany(Streetcred::class);
    }

}
