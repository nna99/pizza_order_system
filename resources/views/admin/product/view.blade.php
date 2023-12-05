@extends('admin.layouts.master')


@section('title','Pizza Details')

@section('search_bar')
    <form class="form-header" action="" method="POST">
        <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection


@section('content')

     <!-- MAIN CONTENT-->
     <div class="main-content mt-5">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="row col-10 offset-1  mb-3">
                        @if (session('updateSuccess'))
                            <div class="">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>p
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <button type="button" class="btn btn-sm btn-dark text-white ms-3" onclick="history.back()"><i class="fa-solid fa-left-long"></i></button>

                            <div class="row py-5">
                                <div class="col-3 offset-1 image">
                                    <a href="#">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail object-fit-cover"  style="height: 175px"/>
                                    </a>
                                </div>
                                <div class="col-8 ">
                                    <div class="btn bg-dark text-white mb-2">{{ $pizza->name }}</div> <br>
                                    <span class="btn bg-dark text-white"><i class="fa-solid fa-money-bill-wave me-2"></i>{{ $pizza->price }} kyats</span>
                                    <span class="btn bg-dark text-white"><i class="fa-solid fa-clock me-2"></i>{{ $pizza->waiting_time }} mins</span>
                                    <span class="btn bg-dark text-white"><i class="fa-solid fa-eye me-2"></i>{{ $pizza->view_count }}</span>
                                    <span class="btn bg-dark text-white"><i class="fa-solid fa-file me-2"></i>{{ $pizza->category_name }}</span>
                                    <span class="btn bg-dark text-white"><i class="fa-solid fa-calendar-days me-2"></i>{{ $pizza->created_at->format('j-m-Y') }}</span>
                                    <div class="border mt-2">

                                        <div class="mt-1 fs-6 ps-3"><i class="fa-solid fa-file-pen"></i> <span class="text-dark ms-1">Description</span></div>
                                    <div class="text-secondary py-2 px-3">{{ $pizza->description }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="float-end">
                                <a href="{{ route('product#updatePage',$pizza->id) }}">
                                    <div class="btn btn-dark">Edit product</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

