<?php

namespace Modules\DmrCard\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DmrCard\Database\factories\CardFactory;

class Card extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

     protected $table='card';
    protected $fillable = [];
    
    protected static function newFactory(): CardFactory
    {
        //return CardFactory::new();
    }
}
