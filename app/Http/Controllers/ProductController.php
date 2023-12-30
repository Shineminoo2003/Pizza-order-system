<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //Pizza List Page
    public function list(){
        $pizzadata = product::leftJoin('categories','products.category_id','=','categories.id')
            ->select('products.*','categories.name as category_name','products.name as product_name')
            //dd($pizzadata->toArray());
            ->when(request('key'),function($searchdata){
            $searchdata->where('products.name','like','%'.request('key').'%');
        })
         ->orderBy('products.id','desc')->paginate(2)->withQueryString();
        //dd($pizzadata->toArray());
        return view('admin.products.pizzalist',['pizzadata' => $pizzadata]);
    }

    //Pizza create page
    public function createPage(){
        $categories = category::select('id','name')->get();
        return view('admin.products.pizzaCreate',['categories' => $categories]);
    }

    //Pizza create
    public function create(Request $request){
        $this->pizzavalidatecheck($request,$create='create');
        $pizzadata = $this->createpizza($request);
        $pizzaimage = uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$pizzaimage);
        $pizzadata['image'] = $pizzaimage;
        product::create($pizzadata);
        session(['pizzacreatae' => 'Pizza create success..']);
        return redirect()->route('pizza#list');
    }

    //pizza detail Page
    public function detail($id){
        $pizzadetail = product::leftJoin('categories','categories.id','products.category_id')
        ->select('products.*','categories.name as category_name','products.name as product_name')
        ->where('products.id',$id)->first();
         //dd($pizzadetail->toArray());
        return view('admin.products.pizzaDetail',['pizzadetail' => $pizzadetail]);
    }

    //pizza delete
    public function delete($id){
        product::where('id',$id)->delete();
        return back();
    }

    //pizza edit
    public function edit($id){
        $editdata = product::where('id',$id)->first();
        $categories = category::select('id','name')->get();
        //dd($editdata->toArray());
        return view('admin.products.pizzaEdit',['editdata' => $editdata,'categories'=>$categories]);
    }

    //pizza update
    public function update(Request $request){
        $this->pizzavalidatecheck($request,$update ='update');
        $pizzadata = $this->createpizza($request);
        if($request->hasFile('image')){
            $imagename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imagename);
            $olddata= product::where('id',$request->id)->first();
            $oldimage = $olddata->image;
            Storage::delete('public/'.$oldimage);
            $pizzadata['image'] = $imagename;
        }
        product::where('id',$request->id)->update($pizzadata);
        return redirect()->route('pizza#list');
    }

    //Pizza validation
    private function pizzavalidatecheck($request,$status){
        $validationrule = ['name'=>'required|min:3|unique:products,name,'.$request->id,'waitingTime'=>'required','categoryId'=>'required','description'=>'required|min:5','price'=>'required'];
        $validationrule['image'] = $status == 'create' ? 'required|mimes:png,jpg' : 'mimes:png,jpg';
        //dd($validationrule);
        Validator::make($request->all(),$validationrule)->validate();
    }

    //Pizza create data
    private function createpizza($request){
        return ['category_id' => $request->categoryId,
                 'name' => $request->name,
                'description' => $request->description,
                'waiting_time' => $request->waitingTime,
                 'price' => $request->price];
    }
}
