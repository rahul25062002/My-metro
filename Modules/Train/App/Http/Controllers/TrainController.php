<?php

namespace Modules\Train\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeBaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Train\App\Models\Train;
use Validator;
class TrainController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
       $_err=array();
       $res=$this->getStandarSuccesFormat();
       try{

        $data=Train::all();
        $datas = $data->getCollection()->transform(function($singledata){
				
            return [
                
            ];
        });
       
        return response()->json($res);


       }catch(\Exception $ex){
            return $this->getStandardErrorFormat($ex,$_err,$res);
       }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
           $_errs=array();
           $res = $this->getStandarSuccesFormat();
           try{
               $data=$request->post();
               $rule=[
                'station_from'=>'required',
                'station_to'=>'required',
                'start_time'=>'sometimes',
                'end_time'=>'sometimes',
                'train_no'=>'sometimes|int'
               ];
               $validater=Validator::make($data,$rule);
               if($validater->fails()){
                $_errs=$validater->errors();
                throw new \Exception(__('common.default_process_err_msg'));
               }
               $wh=$data;
               if(isset($data['train_no'])){
                $wh=[];
                  $wh['train_no']=$data['train_no'];
               }
               
               $train =Train::updateOrCreate($data,$wh);
               
               $res['data']=$train;
               $res['public_msg']=__('common.default_succ_msg');
                return $res;

           }catch(\Exception $ex){
               return $this->getStandardErrorFormat($ex,$_errs);  
           }

        // return view('train::create');
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
        return view('train::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('train::edit');
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
