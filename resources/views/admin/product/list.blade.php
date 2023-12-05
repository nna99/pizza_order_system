@extends('admin.layouts.master')


@section('title','Product List')

@section('search_bar')
    <form class="form-header" action="{{ route('product#list') }}" method="get">
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
                                <h2 class="title-1">Products List</h2>

                            </div>
                            <h4 class="fs-6 text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="table-data__tool-right">
                            <a  href="{{ route('product#createPage') }}" class="au-btn au-btn-icon au-btn--green au-btn--small text-decoration-none">
                                <i class="zmdi zmdi-plus"></i>add products
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-solid fa-download"></i>CSV download
                            </button>
                            <h4 class="fs-6 text-secondary text-center mt-2">Total - {{ $pizza->total() }}</h4>
                        </div>
                    </div>

                    @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

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

                    @if (count($pizza) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="col-2 text-center">Image</th>
                                    <th class="col-2 text-center">Pizza name</th>
                                    <th class="col-2 text-center">Category</th>
                                    <th class="col-2 text-center">Price</th>
                                    <th class="col-2 text-center">View Count</th>
                                    <th class="col-2 text-center"></th>
                                </tr>
                            </thead>
                            @foreach ($pizza as $p)
                            <tbody>

                                    <td class="col-2 text-center"><img src="{{ asset('storage/'.$p->image) }}" class="img-thumbnail object-fit-cover w-100" style="height: 135px"></td>
                                    <td class="col-2 text-center">{{ $p->name }}</td>
                                    <td class="col-2 text-center">{{ $p->category_name }}</td>
                                    <td class="col-2 text-center">{{ $p->price }} Kyats</td>
                                    <td class="col-2 text-center">{{ $p->view_count }} </td>
                                    <td class="col-2 text-center">
                                        <div class="table-data-feature">
                                            <a href="{{ route('product#view',$p->id) }}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('product#updatePage',$p->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('product#delete',$p->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>

                            </tbody>
                            @endforeach
                        </table>
                        {{ $pizza->links() }}
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


