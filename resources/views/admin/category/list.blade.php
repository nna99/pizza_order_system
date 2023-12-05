@extends('admin.layouts.master')


@section('title','Category List')

@section('search_bar')
    <form class="form-header" action="{{ route('category#list') }}" method="get">
        @csrf
        <input class="au-input au-input--xl" type="text" name="key" value="{{ request('key') }}" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection


@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-10 offset-1">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Category List</h2>

                            </div>
                            <h4 class="fs-6 text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="table-data__tool-right">
                            <a  href="{{ route('category#createPage') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                <i class="zmdi zmdi-plus"></i>add item
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-solid fa-download"></i>CSV download
                            </button>
                            <h4 class="fs-6 text-secondary text-center mt-2">Total - {{ $categories->total() }}</h4>
                        </div>
                    </div>


                    @if (session('createSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('createSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-ban"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Name</th>
                                        <th>Created Time</th>
                                        <th>Updated Time</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category )
                                    <tr class="tr-shadow">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                        <td>{{ $category->updated_at->format('j-F-Y') }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('category#editPage',$category->id) }}" class="mx-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('category#delete',$category->id) }}" class="mx-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->appends(request()->query())->links() }}
                        </div>
                    @else
                        <h3 class="text-secondary text-center mt-5">There is no categories here!</h3>


                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
