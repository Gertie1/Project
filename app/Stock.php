<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table="stocks";

    protected $fillable = [
        'amount_received','drug_id','amount_sold','date_received','date_sold'
        ];
    public $timestamps=false;
}
