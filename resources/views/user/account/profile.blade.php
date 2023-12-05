@extends('user.layouts.master')



@section('nav_bar_categories')

    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block ">
                <div class="row align-items-center justify-content-between bg-light py-2  px-xl-5 d-none d-lg-flex"  style="height: 65px; padding: 0 30px;">
                    <div class="logo col-4">
                        <a href="#">
                            <img src="{{ asset('admin/images/icon/logo.png') }}" alt="Cool Admin" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('user#home') }}" class="nav-item nav-link me-3">Home</a>
                            <a href="{{ route('user#cartList') }}" class="nav-item nav-link position-relative me-3">My Cart
                                <span class="position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ count($cart) }}
                                </span>
                            </a>
                            <a href="{{ route('user#contactPage') }}" class="nav-item nav-link me-3">Contact</a>
                            <a href="{{ route('user#cartHistory') }}" class="nav-item nav-link me-3 position-relative">History</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="{{ route('user#cartList') }}" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"></span>
                            </a>
                            <div class="btn-group">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm  dropdown-toggle" data-toggle="dropdown">
                                        <div class="image  dropdown-menu-left dropdonw-menu">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                                @else
                                                    <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm" style="height: 35px" >
                                            @endif
                                        </div>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <form action="{{ route('user#profile') }}" method="get">
                                            <button class="dropdown-item btn bg-secondary my-3 col-10 offset-1 py-1 pe-5" type="submit"><i class="fa-solid fa-user"></i> Account</button>
                                        </form>
                                        <form action="{{ route('user#changePasswordPage') }}" method="get">
                                            <button class="btn bg-warning dropdown-item my-3 col-10 offset-1 py-1 pe-5" type="submit"> <i class="fa-solid fa-key"></i> Change password</button>
                                        </form>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="btn bg-black text-white dropdown-item my-3 col-10 offset-1 py-1 pe-5" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

@endsection



@section('content')

    <div class="main-content mt-5">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-end">
                                <a href="{{ route('user#home') }}"><button class="btn bg-dark text-white rounded" type="button"><i class="fa-solid fa-arrow-left-long me-2"></i> Back</button></a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit your profile</h3>
                            </div>

                            @if (session('updateSuccess'))
                                <div class="col-8 offset-2">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check"></i> {{ session('updateSuccess') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user#edit',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row py-5">
                                    <div class="col-5 offset-1">
                                        <div class="row col-8 offset-2">
                                            @if (Auth::user()->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm" style="height: 250px">
                                                @else
                                                    <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm" style="height: 250px">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.Auth::user()->image) }}" class="img-thumbnail shadow-sm" style="height: 250px">
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

@endsection
