<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['position_name'];

    /**
     * @var string
     */
    protected $table = 'positions';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
