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
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <button class="col-1 fs-5" onclick="history.back()"><i class="fa-solid fa-circle-arrow-left"></i></button>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2 text-dark">{{$pizzadetail->category_name}}</h3>
                            </div>
                            @if (session()->pull('account update'))
                            <div class="mt-3 animate__animated animate__backInRight">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Update success!</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                            <div class="row mt-3">
                                <div class="col-4 position-relative">
                                    <img src="{{ asset('storage/'.$pizzadetail->image) }}" alt="John Doe" />
                                    <div class="position-absolute top-0 rounded-pill bg-info bg-opacity-75 p-1">{{$pizzadetail->waiting_time}}mins<i class="fa-solid fa-clock ps-1"></i></div>
                                </div>
                                <div class="col-6 offset-1 text-primary">
                                    <h1 class="mb-2 fs-4">{{$pizzadetail->product_name}}</h1>
                                    <p class="mb-2 text-muted fs-5 mt-4">{{$pizzadetail->description}}</p>
                                    <p class="mb-2 fs-5 mt-4">{{$pizzadetail->price}}MMK</p>
                                </div>
                            </div>
                            <!--<div class="mt-3 text-center">
                               <a href="{{route('account#edit')}}"><button class="btn btn-danger">Edit</button></a>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
