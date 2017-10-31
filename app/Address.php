<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    protected $table = 'addresses';

    public $timestamps = false;

    /** Addresses >- Users relation many to one
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }

}
