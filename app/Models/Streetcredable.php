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
        return $this->gotStreetcredFromUser();
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
     * Check if a user gave a specific snippet some streetcred
     * @return bool
     */
    public function gotStreetcredFromUser()
    {
        if ($user = auth()->user()) {
            return (bool)$user->streetcred
                ->firstWhere('snippet_id', $this->id);
        }

        return false;
    }

    /**
     * Get the user who gave streetcred to snippet.
     */
    public function streetcred()
    {
        return $this->hasMany(StreetCred::class);
    }

}
