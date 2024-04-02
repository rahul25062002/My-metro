<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeBaseController extends Controller
{
    //

    public function getStandarSuccesFormat(){
        return [
            'succ'=>true,
            'public_msg'=>__('common.default_public_msg'),
            'data'=>[]
        ];
    }

     

    public function getStandardErrorFormat($ex, $_errs, $res = [])
    {
        return response()->json(array_merge($res, array(
            'succ' => false,
            'error_track' => config('app.debug') ? $ex->getFile() . $ex->getLine() : null,
//            'user_details' => array(),
            'public_msg' => $ex->getMessage(),
            'errs' => !empty($_errs) ? $_errs : (object)[]
        )), 200);
    }
    
}
