<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\admin\role;
use App\Model\admin\Permission;
use Illuminate\Validation\ValidationException;
use Session;
use Validator;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::all();
        return view('admin.role.show',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate incoming request
        
        $validator = Validator::make($request->all(), [
          
           'name' => 'required|string|max:50'
         
       ]);
       $validator_unique = Validator::make($request->all(), [
          
           'name' => 'required|string|max:50|unique:roles'
         
       ]);
       if ($validator->fails()) {
            Session::flash('message', 'More than 50 characters.'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back()->withInput();
       }
         if ($validator_unique->fails()) {
            Session::flash('message_unique', 'Unique role.'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back()->withInput();
       }
       $role = new role;
       $role->name = $request->name;
       $role->save();
       $role->permissions()->sync($request->permission);
       return redirect(route('role.index'))->with('success','You have Add successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = role::where('id',$id)->first();
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $validator = Validator::make($request->all(), [
          
           'name' => 'required|string|max:50'
         
       ]);
        if ($validator->fails()) {
            Session::flash('message', 'More than 50 characters.'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back()->withInput();
       }

        $role = role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->permissions()->sync($request->permission);
        return redirect(route('role.index'))->with('success','You have Edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        role::where('id',$id)->delete();
        return redirect()->back()->with('success','You have Delete successfully.');
    }
}
