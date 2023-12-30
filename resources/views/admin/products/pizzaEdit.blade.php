@extends('admin.layouts.master')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <!--<div class="row">
                                    <div class="col-3 offset-8">
                                        <a href="#"><button class="btn bg-dark text-white my-3">List</button></a>
                                    </div>
                                </div>-->
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-dark">Edit Pizza Page</h3>
                            </div>
                            <hr>
                            <form action="{{route('pizza#update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-4">
                                            <img src="{{ asset('storage/'.$editdata->image) }}" alt="John Doe" />
                                        <input type="file" name="image" class="form-control mt-3">
                                        <div class="mt-3"><button class="btn btn-info col-12">Update</button></div>
                                    </div>
                                    <div class="col-7 offset-1">
                                        <label class="mt-2">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Pizza Name.." value="{{ old('name',$editdata->name) }}">
                                            @error('name')
                                            <small class="invalid-feedback">{{$message}}</small> 
                                            @enderror
                                        <label class="mt-2">Category</label>
                                        <select name="categoryId" class="form-select">
                                            <option value="">Choose one</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" @if ($category->id == $editdata->category_id) selected @endif>{{$category->name}}</option>
                                            @endforeach
                                        </select> 
                                        <label class="mt-2">Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description...">{{ old('address',$editdata->description) }}</textarea>
                                        @error('description')
                                        <small class="invalid-feedback">{{$message}}</small> 
                                        @enderror
                                        <label class="mt-2">Price</label>
                                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                            placeholder="Enter price.."
                                            value="{{ old('price', $editdata->price) }}">
                                            @error('price')
                                            <small class="invalid-feedback">{{$message}}</small> 
                                            @enderror
                                        <label class="mt-2">Waiting Time</label>
                                        <input type="text" class="form-control"
                                            value="{{$editdata->waiting_time}}" name="waitingTime" placeholder="Enter waiting time...">
                                        <input type="hidden" name="id" value="{{$editdata->id}}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
