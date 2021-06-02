<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Snippet
 *
 * @mixin IdeHelperSnippet
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $markdown
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $gave_streetcred
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Streetcred[] $streetcred
 * @property-read int|null $streetcred_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\SnippetFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereMarkdown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Snippet withStreetcred()
 */
	class IdeHelperSnippet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Streetcred
 *
 * @mixin IdeHelperStreetcred
 * @property int $id
 * @property int $user_id
 * @property int $snippet_id
 * @property int $streetcred
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred query()
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereSnippetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereStreetcred($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Streetcred whereUserId($value)
 */
	class IdeHelperStreetcred extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Snippet[] $snippets
 * @property-read int|null $snippets_count
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperTag extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Streetcred[] $gaveStreetcred
 * @property-read int|null $gave_streetcred_count
 * @property-read string $profile_photo_url
 * @property-read string $streetcred
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Snippet[] $snippets
 * @property-read int|null $snippets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser extends \Eloquent {}
}

