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
    public function index(Request $re)
    {    
       $_err=array();
       $res=$this->getStandarSuccesFormat();
       try{
           $limit=isset($re->limit)? $re->limit() :10;
        //    dd( $limit);
        $data=Train::query()->paginate($limit);
        // $data->dd();
        $datas = $data->getCollection()->transform(function($singledata){
				
            return [
                "Train_no"=>$singledata->train_no,
                'stationFrom'=>$singledata->station_from,
                'stationTo'=>$singledata->station_to,
                'startTime'=>$singledata->start_time,
                'endTime'=>$singledata->end_time
            ];
        });

        $itemTransformAndPaginated=new  \Illuminate\Pagination\LengthAwarePaginator(
            $datas,
            $data->total(),
            $data->perPage(),
            $data->currentPage(),
            [
                'path'=>\Request::url(),
                'query'=>[
                    'page'=>$data->currentPage()
                ]
            ]

                );

        $res['data']= $itemTransformAndPaginated;
        $res['public_msg']= __('common.default_succ_msg');
       
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
               return response()->json($res);

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
    public function edit(Request $request,$id)
    {
          $_errs=array();
          $res=$this->getStandarSuccesFormat();
          try{

            $data=$request->data();
            $rules=[
                'train_no'=>'requested|exists:train,train_no',
                'station_from'=>'somethimes',
                'station_to'=>'sometimes',
                 'start_time'=>'sometimes',
                 'end_time'=>'sometimes'
            ];

            $validater=Validator::make($data,$rules);

            if($validater->fails()){
                   $_errs=$validater->errors();
                   throw new \Exception(__('common.default_process_err_msg'));
            }

            $train=Train::query();
            $train->where('train_no',$data['train_no']);
            if(!isset($data['station_from'])){
                    $train->station_from=$data['station_from'];
            }

            if(!isset($data['station_to'])){
                $train->station_to=$data['station_to'];
            }

            if(!isset($data['start_time'])){
                $train->start_time=$data['start_time'];
            }

            if(!isset($data['end_time'])){
                $train->end_time=$data['end_time'];
            }

            $train->save();

            $res['public_msg']='Updated the train details';
            return response()->json($res);


          }catch(\Exception $ex){
            return $this->getStandardErrorFormat($ex,$_errs,$res);
          }      




        // return view('train::edit');
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
          $_errs=array();
          $res=$this->getStandarSuccesFormat();
        try{

            $validator=Validator::make(['train_no'=>'required|exists:Train,train_no'],['train_no'=>$id]);
            if($validator->fails()){
               $_errs=$validator->errors();
               throw new \Exception(__('common.default_process_err_msg'));
            }
           
            Train::where('train_no',$id)->delete();

            $res['public_msg']='Train Deleted successfully';

            return response()->json($res);

            
        }catch(\Exception $ex){
            return $this->getStandardErrorFormat($ex,$_errs,$res);
        }
    }
}
