<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $fillable = ['order_number', 'project_name','delivery_date', 'supplier', 'customer','quantity','storage_location','status','archived','created_date','parent_id'
    ];
}
