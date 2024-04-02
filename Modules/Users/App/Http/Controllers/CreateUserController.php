<?php

namespace Modules\Users\App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeBaseController;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Users\App\Models\Users;

class CreateUserController extends HomeBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
       
     
      
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
        //
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
