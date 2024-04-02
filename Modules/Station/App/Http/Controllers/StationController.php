<?php

namespace Modules\Station\App\Http\Controllers;


use App\Http\Controllers\HomeBaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Station\App\Models\Station;

class StationController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
             $_errs=array();
             $res=$this->getStandarSuccesFormat();
             try{
                 if(!isset($request)){
                     $_errs=['request'=>'not set'];
                    }
                    $data=$request->post();
                if(isset($data['id']))
                $rule=[
                     'st_name'=>'sometimes|unique:station,st_name',
                     'location'=>'sometimes|unique:station,location',
                     'distance_c'=>'sometimes',
                     'id'=>'required|exists:station,id|int'
                ];

                if(!isset($data['id']))
                $rule=[
                    'st_name'=>'required|unique:station,st_name',
                    'location'=>'required|unique:station,location',
                    'distance_c'=>'required',
               ];

                $validator=validator::make($data,$rule);

                if($validator->fails()){
                    $_errs=$validator->errors();
                    throw  new \Exception(__('common.default_process_err_msg'));
                }
                $whr=$data;
                if(isset($data['id'])){
                    $whr=[
                        'id'=>$data['id'],
                    ];
                }
                
                
                // dd($data);
                $station=Station::updateOrCreate($whr,$data);
              

                $res['data']=$station;
                $res['public_msg']=__('common.default_succ_msg');
                return $res;

             }catch(\Exception $ex){
                 return $this->getStandardErrorFormat($ex,$_errs);
             }

        // return view('station::index');
    }

    /**
     * Show the form for creating a new resource.
     */
  

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
        return view('station::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('station::edit');
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
