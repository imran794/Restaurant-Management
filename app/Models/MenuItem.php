<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
     protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }

    public function childe()
    {
        return $this->hasMany('App\Models\MenuItem','parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\MenuItem','parent_id', 'id');
    }
}
