<?php

namespace Modules\DmrCard\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeBaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\DmrCard\App\Models\Card;
use Validator;

class DmrCardController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dmrcard::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   $_errs=array();
        $res=$this->getStandarSuccesFormat();
        try{
            $formData=$request->post();
            
            $rule=[
                'user_id'=>'required|bigUnsignedInt|exists:users|unique:card',
            ];
            
            $validate=Validator::make($formData,$rule);
            if($validate->failed()){
                $_errs=$validate->errors();
                throw new \Exception(__('common.default_process_err_msg'));
            }
            
           
            $newCard=new Card;
            $newCard->user_id=$formData['user_id'];
            $newCard->save();
            $res['data']=$newCard;
            $res['public_msg']=__('common.default_succ_msg');

            return response()->json($res);
            

        }catch(\Exception $exp){
            return $this->getStandardErrorFormat($exp,$_errs);    
        }

    }


        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('dmrcard::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dmrcard::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
