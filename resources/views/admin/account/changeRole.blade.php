@extends('admin.layouts.master')


@section('title','User Info')

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
                            <div>
                                <button onclick="history.back()" class="btn btn-outline-secondary"><i class="fa-solid fa-left-long"></i></button>
                            </div>

                            <div class="card-title">
                                <h3 class="text-center title-2">User Info</h3>
                            </div>

                            <form action="{{ route('admin#change',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row py-5">
                                    <div class="col-5 offset-1">
                                        <div class="row col-8 offset-2">
                                            @if ($account->image == null)
                                                @if ($account->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm" style="height: 200px">
                                                @else
                                                    <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm" style="height: 200px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail shadow-sm" style="height: 200px">
                                            @endif
                                        </div>

                                        <div class="row col-12 mt-4">
                                            <button class="btn btn-dark" type="submit">Update <i class="fa-solid fa-circle-right ms-1"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" disabled value="{{ old('name', $account->name ) }}" class="form-control @error('name') is-invalid @enderror" >
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Role</label>
                                            <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin' ) selected @endif >Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="text" name="email" disabled value="{{ old('email',$account->email ) }}" class="form-control @error('email') is-invalid @enderror" >

                                        </div>

                                        <div class="form-group">
                                            <label for="name">phone</label>
                                            <input type="text" name="phone" disabled value="{{ old('phone',$account->phone ) }}" class="form-control @error('phone') is-invalid @enderror" >

                                        </div>

                                        <div class="form-group">
                                            <label for="name">Gender</label>
                                            <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender</option>
                                                <option value="male" @if ($account->gender == 'male'  )  selected @endif>Male</option>
                                                <option value="female" @if ($account->gender == 'female'  )  selected @endif>Female</option>
                                                <option value="other" @if ($account->gender == 'other'  )  selected @endif>Other</option>
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="name">Address</label>
                                            <textarea name="address" id="" disabled cols="30" rows="10" class="form-control @error('adderss') is-invalid @enderror">{{ old('address',$account->address) }}</textarea>
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
