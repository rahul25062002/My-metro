<?php

namespace Modules\Users\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Users\Database\factories\UsersFactory;

class Users extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id','profession','user_name','user_address',
    ];

    protected $table='users';
    protected $primaryKey='user_id';
    
    protected static function newFactory(): UsersFactory
    {
        //return UsersFactory::new();
    }

    public function createNewUser($details){

        $user=new Users();
        $user->user_name= $details['user_name'] ?? null;
        $user->user_address=$details['user_address'] ?? null;
        $user->profession=$details['profession'] ?? null;
        $user->email=$details['email'] ?? null;

        $user->save();

        return $user;

    }
}
