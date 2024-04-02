<?php

namespace Modules\Users\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeBaseController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class UsersController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $_err=array();
        $res=$this->getStandarSuccesFormat();
        try{

        $data=$request->all();

        $validation=Validator::make($data,[
            'limit'=>'sometimes|min:5|max:100|int'
        ]);



        if($validation->fails()){
            $_err=$validation->errors();
            throw new \Exception(__("common.default_process_err_msg"));
        }

        $users=User::query();

        if(!isset($data['limit'])){
            $data['limit']=10;
        }
        $users= $users->paginate( $data['limit']);
       $user= $users->getCollection()->transform(function($eachRow){
            return [
                "User_id"=>$eachRow['user_id'],
                "Full_name"=>$eachRow['user_name'],
                "Card_No"=>$eachRow['card_id']?? 'Not Found',
                "Address"=>$eachRow['user_address']?? 'Not Found',
                "Profession"=>$eachRow['profession']?? 'Not Found',

            ];


        });
        $itemsTransformedAndPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $user,
            $users->total(),
            $users->perPage(),
            $users->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $users->currentPage()
                ]
            ]
        );

         $res['data']= $itemsTransformedAndPaginated;
         $res['public_msg']=__("common.default_succ_msg");
         return response()->json($res);    
 
        }catch(\Exception $ex){
             return $this->getStandardErrorFormat($ex,$_err);
             
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $_err=array();
        $res=$this->getStandarSuccesFormat();
        try{
         $formData=$request->post();
         $rule=[
             'user_name'=>'required|max:225',
             'user_address'=>'sometimes',
             'profession'=>'required|max:225',
             'email'=>'required|email|unique:users'
         ];
 
         $validate=Validator::make($formData,$rule);
 
         if($validate->fails()){
             $_err = $validate->errors();
             throw new \Exception(__('common.default_process_err_msg'));
         }
 
         $obj=new User;
 
         $user=$obj->createNewUser($formData);
 
         
         $res['data']=$user;
         $res['public_msg']=__('users::common.create_user');
 
         return response()->json($res);    
 
        }catch(\Exception $ex){
             return $this->getStandardErrorFormat($ex,$_err);
             
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
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
