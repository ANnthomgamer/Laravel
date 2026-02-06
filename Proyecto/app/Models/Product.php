<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['name','stock','price','category_id','provider_id'];
    
    public function category(){ 
        return $this->belongsTo(Category::class);    
    
    }       
    public function provider(){
        return $this->belongsTo(Category::class);

    }

}

