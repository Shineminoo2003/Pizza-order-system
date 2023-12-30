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
                                <h3 class="text-center title-2">Change Password Form</h3>
                            </div>
                            @if (session()->pull('password change'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <i class="fa-solid fa-circle-check pe-2"></i>
                                <strong>Password change success...</strong>
                                <button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif
                            <form action="{{ route('pass#change') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter old Password...">
                                    @error('oldPassword')
                                       <small class="invalid-feedback">{{$message}}</small> 
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new Password...">
                                    @error('newPassword')
                                       <small class="invalid-feedback">{{$message}}</small> 
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter confirm Password...">
                                    @error('confirmPassword')
                                       <small class="invalid-feedback">{{$message}}</small> 
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Change</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-unlock fs-5"></i>
                                    </button>
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
