@extends('admin.layouts.master')


@section('title','Order List')

@section('search_bar')
    <form class="form-header" action="{{ route('order#list') }}" method="get">
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
            <div class="container-fluid col-10 offset-1">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="">
                        <div class="text-center">
                            <div class="">
                                <h2 class="title-1">Order List</h2>
                            </div>
                            <div class="overview-wrap mb-3">
                                <h4 class="fs-5 text-muted">Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                                <h4 class="fs-5 text-secondary me-5">Total - {{ $order->total() }}</h4>
                            </div>
                            <div class=" mb-3">
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('order#orderStatus') }}" method="get">
                        <div class="mb-3 input-group">
                            <div class="w-25">
                                <select name="orderStatus" id="inputGroupSelect02"  class="custom-select">
                                    <option value="">All</option>
                                    <option value="0" @if(request('orderStatus') == '0')  selected  @endif>Pending</option>
                                    <option value="1" @if(request('orderStatus') == '1')  selected  @endif>Accept</option>
                                    <option value="2" @if(request('orderStatus') == '2')  selected  @endif>Reject</option>
                                </select>
                            </div>
                            <div class="input-group-append">
                                <button class=" btn btn-sm bg-dark text-white fs-6" type="submit"><i class="fa-solid fa-magnifying-glass me-2"></i>search</button>
                            </div>
                        </div>
                    </form>

                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Order Code</th>
                                        <th>Total Price</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="dataList">
                                    @foreach ($order as $o)
                                        <tr>
                                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                                            <td>{{ $o->user_id }}</td>
                                            <td>{{ $o->user_name }}</td>
                                            <td>
                                                <a href="{{ route('order#orderList',$o->order_code) }}" class="text-decoration-none">{{ $o->order_code }}</a>
                                            </td>
                                            <td>{{ $o->total_price }} kyats</td>
                                            <td>{{ $o->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <select name="" id="" class="form-control col-8 changeStatus">
                                                    <option value="0" @if ($o->status == 0) selected  @endif>Pending</option>
                                                    <option value="1" @if ($o->status == 1) selected  @endif>Accept</option>
                                                    <option value="2" @if ($o->status == 2) selected  @endif>Reject</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $order->links() }}
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

            // $('#sortingBtn').change(function(){
            //     $status = $('#sortingBtn').val();

            //     $.ajax({
            //             type : 'get',
            //             url : 'http://localhost:8000/order/ajax/orderStatus',
            //             dataType : 'json',
            //             data : { 'status' : $status },
            //             success : function(response){
            //                 $list = '';
            //                 for($i=0;$i<response.length;$i++){

            //                 // 15-October-2023

            //                 $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $date = $dbDate.getDate() +"-"+ $month[$dbDate.getMonth()] + "-" + $dbDate.getFullYear();

            //                 if(response[$i].status == 0){
            //                     $statusMessage = `
            //                                     <select name="" id="" class="form-control col-8">
            //                                         <option value="0" selected>Pending</option>
            //                                         <option value="1">Accept</option>
            //                                         <option value="2">Reject</option>
            //                                     </select>
            //                                     `
            //                 }else if(response[$i].status == 1){
            //                     $statusMessage = `
            //                                     <select name="" id="" class="form-control col-8">
            //                                         <option value="0">Pending</option>
            //                                         <option value="1" selected>Accept</option>
            //                                         <option value="2">Reject</option>
            //                                     </select>
            //                     `
            //                 }else if(response[$i].status == 2){
            //                     $statusMessage = `
            //                                     <select name="" id="" class="form-control col-8">
            //                                         <option value="0">Pending</option>
            //                                         <option value="1">Accept</option>
            //                                         <option value="2" selected>Reject</option>
            //                                     </select>
            //                     `
            //                 };

            //                     $list += `
            //                 <tr>
            //                     <td>${response[$i].user_id}</td>
            //                     <td>${response[$i].user_name}</td>
            //                     <td>${response[$i].order_code}</td>
            //                     <td>${response[$i].total_price} kyats</td>
            //                     <td>${$date}</td>
            //                     <td>${$statusMessage}</td>
            //                 </tr>
            //                     `
            //                 }
            //                 $('#dataList').html($list)

            //             }
            //         })
            // })

            $('.changeStatus').change(function(){
                $parentNode = $(this).parents("tr");
                $orderId  = $parentNode.find('.orderId').val();
                $status = $parentNode.find('.changeStatus').val();

                $data = {
                    'orderId' : $orderId,
                    'status' : $status
                };
                $.ajax({
                        type : 'get',
                        url : 'http://localhost:8000/order/ajax/change/status',
                        dataType : 'json',
                        data : $data,
                        success : function(response){
                        }
                    })
            })

        })
    </script>
@endsection
