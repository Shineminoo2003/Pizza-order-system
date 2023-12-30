@extends('user.layouts.master')

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
                                <h3 class="text-center title-2 text-dark">Edit Page</h3>
                            </div>
                            <hr>
                            @if (session()->pull('account update'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <i class="fa-solid fa-circle-check pe-2"></i>
                                <strong>Account update success...</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif
                            <form action="{{ route('user#accupdate', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mt-3">
                                    <div class="col-4">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/e1492ff2dcc2e4f435759285dbe59bc7.jpg') }}"
                                                    class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('image/0959ac9957d0dbceb5b921f02555afbb.jpg') }}"
                                                    class="img-thumbnail">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail">
                                        @endif
                                        <input type="file" name="image" class="form-control mt-3 @error('image') is-invalid @enderror">
                                        @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <div class="mt-3"><button class="btn btn-info col-12">Update</button></div>
                                    </div>
                                    <div class="col-7 offset-1">
                                        <label>Name</label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter Your Name.." value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label>Email</label>
                                        <input type="text" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Enter Your Email.."
                                            value="{{ old('email', Auth::user()->email) }}">
                                        @error('email')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label>Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10"
                                            placeholder="Enter Your Address...">{{ old('address', Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label>Phone</label>
                                        <input type="number" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Enter Your Phone.."
                                            value="{{ old('phone', Auth::user()->phone) }}">
                                        @error('phone')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            @if (Auth::user()->gender == 'male')
                                                <option value="male">Male</option>
                                            @endif
                                            @if (Auth::user()->gender == 'female')
                                                <option value="female">Female</option>
                                            @endif
                                        </select>
                                        <label>Role</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ Auth::user()->role }}">
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
