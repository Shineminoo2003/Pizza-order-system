<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //Admin Category list Page
    public function list(){
        //dd(request('key'));
        
        $categorylist = category::when(request('key'),function($searchdata){
        //$searchkey = request('key');
        $searchdata->where('name','like','%'.request('key').'%');
        })
        ->orderBy('id','desc')->paginate(4);
        //dd($categorylist);
        return view('admin.category.list',['categorylist' => $categorylist]);
    }

    //Admin Category create Page
    public function page(){
        return view('admin.category.create');
    }

    //Admin Category create
    public function create(Request $request){
       //dd($request->all());
       $this->categoryvalidate($request);
       $categorydata = $this->createdata($request);
       category::create($categorydata);
       session(['createsuccess'=>'create successful..']);
       return redirect()->route('category#list');
    }

    //Admin Category Delete
    public function delete($id){
       //dd($id);
       DB::table('categories')->where('id','=',$id)->delete();
       session(['deletesuccess'=>'delete successful..']);
       return back();
    }
    
    //Admin Category edit
    public function edit($id){
      //dd($id);
      $editdata = category::where('id','=',$id)->first();
      //dd($editdata);
      return view('admin.category.edit',['editdata' => $editdata]);
    }

    //Admin Category update
    public function update(Request $request){
        $this->categoryvalidate($request);
       $categorydata = $this->createdata($request);
       //dd($categorydata);
       category::where('id','=',$request->categoryId)->update($categorydata);
       return redirect()->route('category#list');
    }
     
    //Category validator check
    private function categoryvalidate($request){
        $validaterule = ['categoryName' => 'required|unique:categories,name,'.$request->categoryId];
         Validator::make($request->all(),$validaterule)->validate();
    }

    //Category data create
    private function createdata($request){
        return ['name' => $request->categoryName];
    }
}
