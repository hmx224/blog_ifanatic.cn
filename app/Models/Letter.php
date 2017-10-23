<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Letter extends Model
{
    protected $table = 'letters';
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'body',
        'dialog_id'
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->forceFill(['has_read' => 'T', 'read_at' => $this->freshTimestamp()])->save();
        }
    }

    public function newCollection(array $models = [])
    {
        return new LetterCollection($models);
    }

    public function read()
    {
        return $this->has_read === 'T';
    }

    public function unread()
    {
        return $this->has_read === 'F';
    }

    public function shouldAddUnReadClass()
    {
        if (Auth::id() === $this->from_user_id) {
            return false;
        }

        return $this->unread();
    }


}
