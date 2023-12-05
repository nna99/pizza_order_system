@extends('admin.layouts.master')


@section('title','Admin List')

@section('search_bar')
    <form class="form-header" action="{{ route('admin#list') }}" method="get">
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
                                <h2 class="title-1">Admin  List</h2>

                            </div>
                            <h4 class="fs-6 text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="overview-wrap mb-3">
                            <h4 class="fs-5 text-secondary me-5">Total - {{ $admin->total() }}</h4>
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
                                    <th class=" text-center">Image</th>
                                    <th class=" text-center">Name</th>
                                    <th class=" text-center">Email</th>
                                    <th class=" text-center">Phone</th>
                                    <th class=" text-center">Address</th>
                                    <th class=" text-center">Role</th>
                                    <th class=" text-center">Action</th>
                                </tr>
                            </thead>
                            @foreach ($admin as $a)
                            <tbody>
                                <tr>
                                    <td class=" text-center">
                                        @if ($a->image == null)
                                            @if ($a->gender == 'male')
                                                <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow-sm" style="height: 135px">
                                            @else
                                                <img src="{{ asset('images/default_female.jpg') }}" class="img-thumbnail shadow-sm" style="height: 135px">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail shadow-sm" style="height: 135px">
                                        @endif
                                    </td>
                                    <td class=" text-center">{{ $a->name }}</td>
                                    <input type="hidden" id="userId" value="{{ $a->id }}">
                                    <td class=" text-center">{{ $a->email }}</td>
                                    <td class=" text-center">{{ $a->phone }}</td>
                                    <td class=" text-center">{{ $a->address }} </td>

                                    <td class=" text-center">
                                        @if (Auth::user()->id == $a->id)
                                        <select name=""  class="custom-select changeRole">
                                            <option value="admin">Admin</option>
                                            <option value="user" disabled>User</option>
                                        </select>
                                        @else
                                        <select name=""  class="custom-select changeRole">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                        @endif
                                    </td>

                                    <td class=" text-center">
                                        @if (Auth::user()->id == $a->id)
                                            <a href="{{ route('admin#delete',$a->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip"  disabled data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete fs-4"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#changeRole',$a->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Info">
                                                    <i class="fa-regular fa-circle-user fs-4"></i>
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ route('admin#delete',$a->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="zmdi zmdi-delete fs-4"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin#changeRole',$a->id) }}" class="mx-1">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Info">
                                                    <i class="fa-regular fa-circle-user fs-4"></i>
                                                </button>
                                            </a>

                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        {{ $admin->links() }}
                    </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){

            $('.changeRole').change(function(){
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();
                $role = $parentNode.find('.changeRole').val();

                $.ajax({
                    type: 'get',
                    url: '/admin/ajax/changeRole',
                    dataType: 'json',
                    data: {
                        'userId' : $userId,
                        'role' : $role
                    }
                })
                location.reload();
            })

        })
    </script>
@endsection


