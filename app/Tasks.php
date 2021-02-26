<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'todo_tasks';

    protected $fillable = [
        'id',
        'title',
        'todo_list_id',
        'is_done',
        'position'
    ];
}
