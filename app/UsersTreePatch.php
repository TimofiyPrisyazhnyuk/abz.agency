<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTreePatch extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_parent_id',
        'user_child_id'
        ];

    /**
     * @var string
     */
    protected $table = 'users_tree_patchs';

    /**
     * @var bool
     */
    public $timestamps = false;
}
