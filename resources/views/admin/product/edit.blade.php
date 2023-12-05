{{-- @extends('admin.layouts.master')


@section('title','Pizza Edit Page')

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

                                <form action="{{ route('product#update',$pizza->id) }}" method="post"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row py-5">
                                        <div class="col-3 offset-1 image">
                                            <a href="#">
                                                <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail object-fit-cover"  style="height: 235px"/>
                                            </a>

                                            <div class="form-group mt-3">
                                                <label class="control-label mb-1">Image</label>
                                                <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                                @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">

                                            <div class="">
                                                <button class="btn btn-dark" type="submit"><i class="fa-solid fa-pen-to-square me-2"></i>Update</button>
                                            </div>

                                        </div>
                                        <div class="col-7 ">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" name="pizzaName" value="{{ $pizza->name }}" placeholder="Enter name..." class="form-control">
                                                @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex row">
                                                <div class="form-group col-6 ">
                                                    <label for="price">Price</label>
                                                    <input type="number" id="price" name="pizzaPrice" value="{{ $pizza->price }}" class="form-control ">
                                                    @error('pizzaPrice')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="waitingTime">Waiting Time</label>
                                                    <input type="number" id="waitingTime" name="pizzaWaitingTime" value="{{ $pizza->waiting_time }}" class="form-control ">
                                                    @error('pizzaWaitingTime')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="d-flex row">
                                                <div class="form-group col-4">
                                                    <label for="viewCount">View Count</label>
                                                    <input type="number" name="pizzaViewCount" id="viewCount" value="{{ $pizza->view_count }}" class="form-control" disabled>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label >Create Time</label>
                                                    <input type="text" value="{{ $pizza->created_at->format('j-m-Y') }}" class="form-control" disabled>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label>Choose Category</label>
                                                    <select name="pizzaCategory" class="form-control">
                                                        @foreach ($category as $c)
                                                            <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif >{{ $c->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pizzaCategory')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea name="pizzaDescription" id="description" cols="30" rows="10" class="form-control">{{ $pizza->description }}</textarea>
                                                @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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
 --}}


 @extends('admin.layouts.master')


@section('title','Product Create Page')

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
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="text-end">
                        <button class="btn bg-dark text-white my-3" onclick="history.back()">Back</button>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-5 offset-1">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" class="img-thumbnail w-100 object-fit-contain shadwo-sm" style="height: 175px">

                                        <div class="form-group ">
                                            <label class="control-label mb-1">Image</label>
                                            <input id="cc-pament" name="pizzaImage" type="file" class="form-control @error('pizzaImage') is-invalid @enderror"  aria-required="true" aria-invalid="false" >
                                            @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <input type="hidden" value="{{ $pizza->id }}" name="pizzaId">

                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" value="{{ old('pizzaPrice',$pizza->price) }}" aria-required="true" aria-invalid="false" placeholder="Enter pizza price...">
                                            @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" aria-required="true" aria-invalid="false" placeholder="Enter pizza waiting time...">
                                            @error('pizzaWaitingTime')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="d-flex">
                                            <div class="">
                                                <input type="text" name="" value="{{ $pizza->created_at->format('j-F-Y') }}" disabled class="form-control">
                                            </div>
                                            <div class="">
                                                <input type="text" name="" value="{{ $pizza->view_count }}" disabled class="form-control">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName') is-invalid @enderror" value="{{ old('pizzaName',$pizza->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter pizza name...">
                                            @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror" >
                                                <option value="">Choose category</option>
                                                @foreach ($category as  $c)
                                                <option value="{{ $c->id }}" @if ($pizza->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                           <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter pizza description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block mt-3">
                                        <span id="payment-button-amount">Update</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
