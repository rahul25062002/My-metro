<?php

namespace Modules\Train\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Train\Database\factories\TrainFactory;

class Train extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='train';
    public $timestamps = false; 

    protected $primaryKey='train_no';
    protected $fillable = [
        'station_from',
        'station_to',
        'start_time',
        'end_time'
    ];

   
    
    protected static function newFactory(): TrainFactory
    {
        //return TrainFactory::new();
    }
}
