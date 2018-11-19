<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contact;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.user.index');
    }

    /*
    get data ajax with Datatables
     */
    public function getData()
    {
    	return Datatables::of(User::query())
    	->addColumn('action', function ($user) {
    		return '<a title="List user" href="http://dss.me/admin/user-account/" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'.$user["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$user["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$user["id"].'></a>';
    	})
    	->editColumn('is_farmer', function ($user)
    	{
    		if ($user->is_farmer==1) {
    			return '<input type="checkbox" id="'.$user->is_farmer.'"  checked="true"/>';
    		} else {
    			return '<input type="checkbox" id="'.$user->is_farmer.'" />';
    		}
    		
    	})
    	->editColumn('mobile', function($user){
    		return $user->contact->mobile;
    	})
    	->editColumn('address', function($user){
    		return $user->contact->address;
    	})
    	->editColumn('updated_at', function($user){
    		return $user->updated_at->format('H:i:s d/m/Y');
    	})
    	->editColumn('created_at', function($user){
    		return $user->created_at->format('H:i:s d/m/Y');
    	})
    	->setRowId(function ($user) {
    		return 'row-'.$user->id;
    	})
    	->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$data['password'] = bcrypt($request->password);
    	$data['is_farmer'] = $request->type_account;
    	$date = date('YmdHis', time());
    	if ($request->hasFile('avatar')) {
    		$extension = '.'.$data['avatar']->getClientOriginalExtension();
    		$file_name = md5($request->name).'_'. $date . $extension;
    		$data['avatar']->storeAs('public/users/avatar',$file_name);
    		$data['avatar'] = 'storage/users/avatar/'.$file_name;
    	} else {
    		$data['avatar']='storage/users/avatar/user-default.png';
    	}
    	$data['username'] = $date.str_slug($request->name);
    	$user = User::create($data);
    	if ($user) {
    		$data['username'] = $user['username'];
    		$contact = Contact::create($data);
    		if ($contact) {
    			$user['contact'] = $user->contact;
    			$user['check_farmer'] = $user->is_farmer=1?'checked="true"':'';
    			return $user;
    		} else {                
    			User::find($user['id'])->delete();
    			return $contact;
    		}
    	}  else {
    		return $user;
    	}    
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
    	$user = User::find($id);
    	$user['contact'] = $user->contact;        
    	return $user;
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
    	$data = $request->all();
    	$res = User::find($id)->update($data);
    	if ($res == true) {
    		$user = User::find($id);
    		$user->contact->mobile = $data['mobile'];
    		$user->contact->address = $data['address'];
    		$user->push();
    		return $user;
    	} else {
    		return response([], 400);
    	}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	return User::find($id)->delete()?response()->json('success'):response([],400);
    }
}
