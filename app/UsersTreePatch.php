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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentUsers()
    {
        return $this->belongsTo(User::class, 'user_parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function childUsers()
    {
        return $this->belongsTo(User::class, 'user_child_id', 'id');
    }
}
