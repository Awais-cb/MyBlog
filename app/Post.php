<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	// We can modify these prams from model
    // Table name
    protected $table = 'posts';
    // Primary key
    protected $primaryKey = 'id';
    // Timestamp if we need it or not
    protected $timeStamps = true;
    // Made them all protected to be extended in controller

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
