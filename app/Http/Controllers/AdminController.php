<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Contact;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin.index');
    }

    /*
    get data ajax with Datatables
     */
    public function getData()
    {
        return Datatables::of(Admin::query())
        ->addColumn('action', function ($admin) {
            return '<a title="List admin" href="http://dss.me/admin/admin-account/" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'.$admin["id"].'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$admin["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$admin["id"].'></a>';
        })
        ->editColumn('mobile', function($admin){
            return $admin->contact->mobile;
        })
        ->editColumn('address', function($admin){
            return $admin->contact->address;
        })
        ->editColumn('updated_at', function($admin){
            return $admin->updated_at->format('H:i:s d/m/Y');
        })
        ->editColumn('created_at', function($admin){
            return $admin->created_at->format('H:i:s d/m/Y');
        })
        ->setRowId(function ($admin) {
            return 'row-'.$admin->id;
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
        $date = date('YmdHis', time());
        if ($request->hasFile('avatar')) {
            $extension = '.'.$data['avatar']->getClientOriginalExtension();
            $file_name = md5($request->name).'_'. $date . $extension;
            $data['avatar']->storeAs('public/admins/avatar',$file_name);
            $data['avatar'] = 'storage/admins/avatar/'.$file_name;
        } else {
            $data['avatar']='storage/admins/avatar/user-default.png';
        }
        $data['username'] = $date.str_slug($request->name);
        $admin = Admin::create($data);
        if ($admin) {
            // $data['username'] = $admin['username'];
            $contact = Contact::create($data);
            if ($contact) {
                $admin['contact'] = $admin->contact;
                return $admin;
            } else {                
                Admin::find($admin['id'])->delete();
                return $contact;
            }
        }  else {
            return $admin;
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
        $admin = Admin::find($id);
        $admin['contact'] = $admin->contact;        
        return $admin;
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
        $res = Admin::find($id)->update($data);
        if ($res == true) {
            $admin = Admin::find($id);
            $admin->contact->mobile = $data['mobile'];
            $admin->contact->address = $data['address'];
            $admin->push();
            return $admin;
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
        return Admin::find($id)->delete()?response()->json('success'):response([],400);
    }
}
