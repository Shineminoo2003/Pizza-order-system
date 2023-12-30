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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    <div class="d-sm-flex flex-row-reverse">
                        <form action="{{ route('category#list') }}" method="GET">
                            @csrf
                            <div class="d-flex mb-3">
                                <input type="text" name="key" class="form-control text-muted"
                                    placeholder="Category Search...." value="{{request('key')}}">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-brands fa-searchengin"></i></button>
                            </div>
                        </form>
                    </div>
                    @if (session()->pull('createsuccess'))
                        <div class="d-sm-flex flex-row-reverse">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Create success!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if (session()->pull('deletesuccess'))
                        <div class="d-sm-flex flex-row-reverse">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Delete success!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive table-responsive-data2">
                        @if ($categorylist->total() != 0)
                        <table class="table table-data2 text-center mb-2">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Category_Name</th>
                                    <th>Created time</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <h4 class="mb-2">Total : {{$categorylist->total()}}</h4>
                                @foreach ($categorylist as $category)
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td class="desc">{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-m-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('category#edit',$category->id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                </a>
                                                <a href="{{ route('category#delete', $category->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h3 class="text-muted text-center mt-2">There is no category here....</h3> 
                        @endif
                        
                        {{ $categorylist->appends(request()->query())->links() }}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
