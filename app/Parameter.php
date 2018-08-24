<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Parameter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parameters';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'weight', 'type'];

    /**
     * The classifications that belong to the shop.
     */
    public function tasks(): BelongsToMany
     {
         return $this->belongsToMany('App\Task');
     }

    
}
