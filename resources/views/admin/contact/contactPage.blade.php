@extends('admin.layouts.master')


@section('title','User Contact Page')

@section('search_bar')
    <form class="form-header" action="{{ route('admin#contactPage') }}" method="get">
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
                                <h2 class="title-1">Contact Page</h2>

                            </div>
                            <h4 class="fs-6 text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="overview-wrap mb-3">
                            <h4 class="fs-5 text-secondary me-5">Total - {{ $contact->total() }} </h4>
                        </div>
                    </div>



                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-ban"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class=" text-center">Id</th>
                                    <th class=" text-center">Name</th>
                                    <th class=" text-center">Email</th>
                                    <th class=" text-center">Message</th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($contact as $c)
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $c->id }}</td>
                                    <td class=" text-center">{{$c->name }}</td>
                                    <input type="hidden" id="userId" value="{{$c->id }}">
                                    <td class=" text-center">{{$c->email }}</td>
                                    <td class="text-center">{{ $c->message }}</td>
                                    <td class=" text-center">
                                        <a href="{{ route('admin#delete',$c->id) }}" class="mx-1">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete fs-4"></i>
                                            </button>
                                        </a>
                                    </td>

                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    <div class="">
                        {{ $contact->links() }}
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection




