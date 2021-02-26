<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = 'todo_lists';

    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id'
    ];

    public function getAuthor()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
