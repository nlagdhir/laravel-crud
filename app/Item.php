<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'qty', 'price', 'manufacturer', 'model', 'date_of_purchased'
    ];

    /*
    * Get user of current item
    */
    public function user()
    {   
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getDateOfPurchasedAttribute($value)
    {
    	return date('d-m-Y',strtotime($value));
    }

}
