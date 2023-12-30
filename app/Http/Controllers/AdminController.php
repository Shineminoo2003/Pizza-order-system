<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //admin password change page
    public function changePage(){
        return view('admin.account.password');
    }

    //admin account Page
    public function account(){
        return view('admin.account.detail');
    }

    //admin account list
    public function list(){
        $acclist = User::when(request('key'),function($searchdata){
            $searchdata->where('name','like','%'.request('key').'%')
            ->orWhere('email','like','%'.request('key').'%')
            ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        return view('admin.account.list',['acclist' => $acclist]);
    }

    //admin account delete
    public function delete($id){
        User::where('id',$id)->delete();
        //session(['deletesuccess'=>'delete successful..']);
        return back();
    }

    //admin account role change
    public function rolechange($id,Request $request){
        $roledata = ['role' => $request->role];
        User::where('id',$id)->update($roledata);
        return redirect()->route('admin#list');
    }

    //admin password change
    public function change(Request $request){
        $this->passwordvalidatecheck($request);
        $currentuserdata = User::where('id','=',Auth::user()->id)->first();
        if(Hash::check($request->oldPassword,$currentuserdata->password)){
            $data = ['password' => Hash::make($request->newPassword)];
            User::where('id','=',Auth::user()->id)->update($data);
            session(['password change' => 'password change success..']);
            return back();
            //dd('password change success..');
        }
        return back();
    }

    //admin account edit page
    public function edit(){
        return view('admin.account.edit');
    }

    //admin account update
    public function update($id,Request $request){
        $this->datavalidatecheck($request);
        $data = $this->updatedata($request);
        if($request->hasFile('image')){
            $imagename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imagename);
            if(Auth::user()->image){
                Storage::delete('public/'.Auth::user()->image);
            }
            $data['image'] = $imagename;
        }
        User::where('id','=',$id)->update($data);
        session(['account update' => 'update success...']);
        return redirect()->route('account#Page');
    }

    //admin account data update
    private function updatedata ($request){
        return ['name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone];
    }

    //admin account data validate check
    private function datavalidatecheck($request){
        Validator::make($request->all(),['name' => 'required','email' => 'required','address' => 'required','phone' => 'required','image' => 'mimes:png,jpg'])->validate();
    }

    //password validate check
    private function passwordvalidatecheck($request){
        $validaterule = ['oldPassword' => 'required|min:6|max:10',
        'newPassword' => 'required|min:6|max:10',
        'confirmPassword' => 'required|min:6|max:10|same:newPassword'];
       Validator::make($request->all(),$validaterule)->validate();
    }
}
