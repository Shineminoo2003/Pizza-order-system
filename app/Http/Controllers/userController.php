<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    //user home page
    public function home(){
        $pizzadata = product::get();
        $categories = category::get();
        return view('user.main.home',['pizzadata' => $pizzadata, 'categories' => $categories]);
    }

    //user account password Page
    public function password(){
        return view('user.account.password');
    }

    //user account password change
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
        session(['oldpassword not same' => 'password change success..']);
        return back();
    }

    //user account edit Page
    public function accedit(){
        return view('user.account.edit');
    }

    //user account update 
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
        return back();
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
