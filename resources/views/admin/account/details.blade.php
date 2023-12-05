@extends('admin.layouts.master')


@section('title','Account Info')

@section('search_bar')
    <form class="form-header" action="" method="get">
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
                <div class="col-lg-6 offset-3">
                    <div class="row col-10 offset-1  mb-3">
                        @if (session('updateSuccess'))
                            <div class="">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <div class="row py-5">
                                <div class="col-3 offset-1 image">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm w-100" style="height: 175px">
                                        @else
                                            <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm w-100" style="height: 175px">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm w-100" style="height: 175px">
                                    @endif
                                </div>
                                <div class="col-6 offset-1">
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h5>
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-at me-3"></i>{{ Auth::user()->email }}</h5>
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-phone me-3"></i>{{ Auth::user()->phone }}</h5>
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-venus-mars me-3"></i>{{ Auth::user()->gender }}</h5>
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-location-dot me-3"></i>{{ Auth::user()->address }}</h5>
                                    <h5 class="mb-3 fs-6"><i class="fa-solid fa-user-clock me-3"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h5>
                                </div>
                            </div>


                                <div class="float-end">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark">Edit profile</button>
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




{{--  --}}
