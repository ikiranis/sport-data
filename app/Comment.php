<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Comment
 *
 * @property int $id
 * @property int|null $post_id
 * @property string $body
 * @property string $author
 * @property string $email
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $approved
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereApproved($value)
 * @property-read \App\Post|null $post
 */
class Comment extends Model
{
    use Uuids;

    public $incrementing = false;

    // The attributes that are mass assignable
    protected $fillable = [
        'post_id',
        'body',
        'author',
        'email',
        'approved'
    ];

    /**
     * Relationship with post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post() {
        return $this->belongsTo('App\Post');
    }

}
