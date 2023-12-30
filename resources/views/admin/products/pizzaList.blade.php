@extends('admin.layouts.master')


@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('pizza#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="d-sm-flex flex-row-reverse">
                        <form action="{{ route('pizza#list') }}" method="GET">
                            @csrf
                            <div class="d-flex mb-3">
                                <input type="text" name="key" class="form-control text-muted"
                                    placeholder="Category Search...." value="{{request('key')}}">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-brands fa-searchengin"></i></button>
                            </div>
                        </form>
                    </div>
                    @if (session()->pull('pizzacreatae'))
                        <div class="d-sm-flex flex-row-reverse">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Create success!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive table-responsive-data2">
                        @if ($pizzadata->total() != 0)
                        <table class="table table-data2 text-center mb-2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Count</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <h4 class="mb-2">Total : {{$pizzadata->total()}}</h4>
                                @foreach ($pizzadata as $pizza)
                                    <tr class="tr-shadow">
                                        <td class="col-2"><img src="{{asset('storage/'.$pizza->image)}}" class="rounded"></td>
                                        <td>{{$pizza->product_name}}</td>
                                        <td>{{$pizza->price}}</td>
                                        <td>{{$pizza->category_name}}</td>
                                        <td>{{$pizza->view_count}}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('pizza#detail',$pizza->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="View">
                                                    <i class="fa-regular fa-eye"></i>
                                                </button>
                                                </a>
                                                <a href="{{route('pizza#edit',$pizza->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                </a>
                                                <a href="{{route('pizza#delete',$pizza->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5 class=" text-center mt-3 fs-4 text-danger">There is no pizza here....</h5>
                        @endif
                        
                        {{$pizzadata->links()}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
