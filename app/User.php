<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';

    public $timestamps = false;

    /** Users -< Addresses relation one to many
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Adress()
    {
        return $this->hasMany('App\Address');
    }

}
