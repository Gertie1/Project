<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table="diseases";

    protected $fillable = [
        'name',

    ];

    public $timestamps=false;

    public function disease_drug()
    {
        return $this->belongsTo('App\Disease_Drug');
    }
}
