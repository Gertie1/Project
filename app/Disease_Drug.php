<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease_Drug extends Model
{
    protected $table="diseases_drugs";

    protected $fillable = [
        'disease_id','drug_id','id',

    ];

    public $timestamps=false;
}
