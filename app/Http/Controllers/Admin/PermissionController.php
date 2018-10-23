<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Session;
use Validator;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        return view('admin.permission.show',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.create');
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
          
           'name' => 'required|unique:permissions'
         
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
       
       $permission = new Permission;
       $permission->name = $request->name;
       $permission->for = $request->for;
       $permission->save();
      return redirect(route('permission.index'))->with('success','You have Add successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $permission = Permission::find($permission->id);
        return view('admin.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
    // validate incoming request
    $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:50'
    ]);
    if ($validator->fails()) {
            Session::flash('message', 'More than 50 characters.'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back()->withInput();
    }
    $permission = Permission::find($permission->id);
    $permission->name = $request->name;
    $permission->for = $request->for;
    $permission->save();
    return redirect(route('permission.index'))->with('success','You have Edit successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\admin\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
    
        Permission::where('id',$permission->id)->delete();
        return redirect()->back()->with('success','You have Delete successfully.');
    }
}
