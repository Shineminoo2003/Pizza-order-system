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
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2 text-dark">Account Detail</h3>
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
                                <div class="col-4">
                                    @if (Auth::user()->image == null)
                                        <img src="https://i.pinimg.com/564x/95/14/a2/9514a2106bdf506dc2ed2047ae4ba908.jpg">
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" />
                                    @endif
                                </div>
                                <div class="col-6 offset-2 text-primary">
                                    <p class="mb-2"><i class="fa-regular fa-circle-user me-1"></i>{{Auth::user()->name}}</p>
                                    <p class="mb-2"><i class="fa-regular fa-envelope me-1"></i>{{Auth::user()->email}}</p>
                                    <p class="mb-2"><i class="fa-regular fa-address-card me-1"></i>{{Auth::user()->address}}</p>
                                    <p class="mb-2"><i class="fa-solid fa-phone me-1"></i>{{Auth::user()->phone}}</p>
                                    <p class="mb-2"><i class="fa-solid fa-venus-mars me-1"></i>{{Auth::user()->gender}}</p>
                                </div>
                            </div>
                            <div class="mt-3 text-center">
                               <a href="{{route('account#edit')}}"><button class="btn btn-danger">Edit Profile</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
