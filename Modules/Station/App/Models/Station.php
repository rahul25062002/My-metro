<?php

namespace Modules\Station\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Station\Database\factories\StationFactory;

class Station extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='station';
    protected $fillable = ['distance_c','st_name','location'];
    
    protected static function newFactory(): StationFactory
    {
        //return StationFactory::new();
    }
    public $timestamps = false; 
}
