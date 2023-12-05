@extends('admin.layouts.master')


@section('title','Account Info')

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
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit your profile</h3>
                            </div>

                            <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row py-5">
                                    <div class="col-5 offset-1">
                                        <div class="row col-8 offset-2">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm w-100" style="height: 180px">
                                                @else
                                                    <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm w-100" style="height: 180px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm w-100" style="height: 180px">
                                            @endif
                                        </div>

                                        <div class="row col-12 mt-4">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="row col-12 mt-4">
                                            <button class="btn btn-dark" type="submit">Update <i class="fa-solid fa-circle-right ms-1"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" value="{{ old('name', Auth::user()->name ) }}" class="form-control @error('name') is-invalid @enderror" >
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="text" name="email" value="{{ old('email',Auth::user()->email ) }}" class="form-control @error('email') is-invalid @enderror" >
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">phone</label>
                                            <input type="text" name="phone" value="{{ old('phone',Auth::user()->phone ) }}" class="form-control @error('phone') is-invalid @enderror" >
                                            @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender</option>
                                                <option value="male" @if (Auth::user()->gender == 'male'  )  selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female'  )  selected @endif>Female</option>
                                                <option value="other" @if (Auth::user()->gender == 'other'  )  selected @endif>Other</option>
                                            </select>
                                            @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <textarea name="address" id="" cols="30" rows="10" class="form-control @error('adderss') is-invalid @enderror">{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Role</label>
                                            <input type="text" name="role" value="{{ old('role',Auth::user()->role ) }}" class="form-control "  disabled>
                                        </div>
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
