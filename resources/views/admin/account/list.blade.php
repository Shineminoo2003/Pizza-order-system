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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="#">
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
                        <form action="{{ route('admin#list') }}" method="GET">
                            @csrf
                            <div class="d-flex mb-3">
                                <input type="text" name="key" class="form-control text-muted"
                                    placeholder="Search...." value="{{ request('key') }}">
                                <button type="submit" class="btn btn-primary"><i
                                        class="fa-brands fa-searchengin"></i></button>
                            </div>
                        </form>
                    </div>
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
                        @if ($acclist->total() != 0)
                            <table class="table table-data2 text-center mb-2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr class="spacer"></tr>
                                <tbody>
                                    <h4 class="mb-2">Total : {{ $acclist->total() }}</h4>
                                    @foreach ($acclist as $acc)
                                        <tr class="tr-shadow">
                                            <td class="col-2">
                                                @if ($acc->image == null)
                                                    @if ($acc->gender == 'male')
                                                        <img
                                                            src="{{ asset('image/e1492ff2dcc2e4f435759285dbe59bc7.jpg') }}">
                                                    @else
                                                        <img
                                                            src="{{ asset('image/0959ac9957d0dbceb5b921f02555afbb.jpg') }}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $acc->image) }}">
                                                @endif
                                            </td>
                                            <td class="desc">{{ $acc->name }}</td>
                                            <td>{{ $acc->email }}</td>
                                            <td>{{ $acc->phone }}</td>
                                            <td>{{ $acc->gender }}</td>
                                            <td>{{ $acc->address }}</td>
                                            <td>
                                                <form action="{{ route('admin#role', $acc->id) }}" method="POST">
                                                    @csrf
                                                    <div class="d-flex">
                                                        <select name="role" class="rounded-pill p-1">
                                                            <option
                                                                value="admin"@if ($acc->role == 'admin') selected @endif>
                                                                Admin</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        @if ($acc->id != Auth::user()->id)
                                                            <div class="table-data-feature ms-2">
                                                                <button class="item me-1" data-toggle="tooltip"
                                                                    data-placement="top" title="Change Role">
                                                                    <i class="fa-solid fa-person-circle-check"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                @if ($acc->id == Auth::user()->id)
                                                @else
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('admin#delete', $acc->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $acclist->links() }}
                        @else
                            <h3 class="text-muted text-center mt-2">There is no data here....</h3>
                        @endif

                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
