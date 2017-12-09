<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $primaryKey = 'id';
    public $table = "sub_category";
    public $timestamp = true;
}
