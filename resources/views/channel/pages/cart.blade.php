@extends('channel.layouts.master')
@section('css')
@include('channel.layouts.css') 
<link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_responsive.css') }}"> 
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrapv4.0/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style>
th{
    text-align: center;
}
td{
    text-align: center;
}
</style>
@endsection

@section('navigation')
@include('channel.layouts.navigation')
@endsection

@section('content')
<div class="container single_product_container">
    <div class="row">
        <!-- Breadcrumbs -->

        <div class="breadcrumbs d-flex flex-row align-items-center">
            <ul>
                <li><a href="{{ route('channel.index') }}">Home</a></li>
                {{-- <li><a href=""><i class="fa fa-angle-right" aria-hidden="true"></i></a></li> --}}
                <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Thông tin giỏ hàng</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-10">
            <a class="btn btn-primary" href='{{ asset('') }}' style="margin-bottom: 20px;"><i class="fa fa-pagelines" aria-hidden="true"> Tiếp tục mua sắm</i></a>
        </div>
        <div class="col-2">
            <a class="btn btn-success" data-toggle="modal" href='#modalPayment' style=" margin-bottom:20px;  float: right;"><i class="fa fa-pagelines" aria-hidden="true">Đặt hàng</i></a>
            <div class="modal fade" id="modalPayment">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">                            
                            <h4 class="modal-title">Thông tin nhận hàng</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ asset('') }}trader/pay" method="POST" role="form">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="">Họ tên người nhận</label>
                                    <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="number" class="form-control" id="mobile" name="mobile" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Địa chỉ nhận</label>
                                    <input type="text" class="form-control" id="address" placeholder="address" name="address" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Cách thức thanh toán và giao hàng: SHIPCODE</label>
                                </div>   
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        
    </div>
    <div class="row">
        <table id="tblCart" class="table table-bordered table-striped text-center tblCart" style="width:100%">
            <thead >
                <tr class="text-center">
                    <th width="10%">Mã NS</th>
                    <th>Ảnh</th>
                    <th>Nông sản</th>
                    <th>Số lượng</th>
                    <th>Gía sale</th>
                    <th>Giảm giá </th>
                    <th>Thành tiền </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $item)
                <tr id="row-{{$item->rowId}}">
                    <td >{{$item->id}}</td>
                    <td><img src="{{ asset('') }}{{$item->options->thumbnail}}" alt="" style="height: 100px"></td>
                    <td class="text-justify">{{$item->name}}</td>
                    <td>                        
                        <a class="btn btn-sm btn-danger btnDecrease " data-item-rowid="{{$item->rowId}}" ><i class="fa fa-minus" aria-hidden="true"></i>
                        </a>
                        <span style="margin: 10px 20px">{{$item->qty}} {{$item->options->unit}}</span>
                        
                        <a class="btn btn-sm btn-success btnIncrease" data-item-rowid="{{$item->rowId}}"><i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td>{{$item->price}}</td>
                    <td>{{$item->options->discount}}</td>
                    <td>{{$item->price*$item->qty}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="6" rowspan="" headers="">Thuế</td>
                    <td id="tax">{{$tax}}</td>
                </tr>
                <tr>
                    <td colspan="6" rowspan="" headers="">Tổng tiền</td>
                    <td id="total">{{$total}}</td>
                </tr>
            </tbody>
            
        </table>
    </div>
</div>
</section>
<!-- /.content -->
@endsection


@section('js')
<script src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('shop/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('shop/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#tblCart').on('click', '.btnIncrease',function(event) {
        event.preventDefault();
        var rowId = $(this).data('item-rowid');
        var row = document.getElementById('row-'+rowId);
        // alert(row);
        $.ajax({
            url: '{{ asset('') }}trader/order/increase/'+rowId,
            type: 'GET',            
            success: function(res) {
                toastr['success']('Update quantity successfull!');
                row.remove();
                // alert(res);
                $('#tblCart').prepend('<tr id="row-'+res.item['rowId']+'"><td>'+res.item['id']+'</td><td><img src="http://agri.me/'+res.item['options']['thumbnail']+'" alt="" style="height: 100px"></td><td class="text-justify">'+res.item['name']+'</td><td><a class="btn btn-sm btn-danger btnDecrease" data-item-rowid="'+res.item['rowId']+'"><i class="fa fa-minus" aria-hidden="true"></i></a><span style="margin: 10px 20px">'+res.item['qty']+ res.item['options']['unit'] +'</span><a class="btn btn-sm btn-success btnIncrease  " data-item-rowid="'+res.item['rowId']+'"><i class="fa fa-plus" aria-hidden="true"></i></a></td><td>'+res.item['price']+'</td><td>'+res.item['options']['discount']+'</td><td>'+res.item['price']*res.item['qty']+'</td></tr>');
                $('#total').text(res.total);
                $('#tax').text(res.tax);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                toastr['error']('Update quantity failed!');
            }
        })
    });
    $('#tblCart').on('click','.btnDecrease', function(event) {
        event.preventDefault();
        var rowId = $(this).data('item-rowid');
        var row = document.getElementById('row-'+rowId);
        // alert(row);
        $.ajax({
            url: '{{ asset('') }}trader/order/decrease/'+rowId,
            type: 'GET',            
            success: function(res) {
                toastr['success']('Update quantity successfull!');
                row.remove();
                // alert(res);
                $('#total').text(res.total);
                $('#tax').text(res.tax);
                $('#tblCart').prepend('<tr id="row-'+res.item['rowId']+'"><td>'+res.item['id']+'</td><td><img src="http://agri.me/'+res.item['options']['thumbnail']+'" alt="" style="height: 100px"></td><td class="text-justify">'+res.item['name']+'</td><td><a class="btn btn-sm btn-danger btnDecrease " data-item-rowid="'+res.item['rowId']+'"><i class="fa fa-minus" aria-hidden="true"></i></a><span style="margin: 10px 20px">'+res.item['qty']+ res.item['options']['unit'] +'</span><a class="btn btn-sm btn-success btnIncrease" data-item-rowid="'+res.item['rowId']+'"><i class="fa fa-plus" aria-hidden="true"></i></a></td><td>'+res.item['price']+'</td><td>'+res.item['options']['discount']+'</td><td>'+res.item['price']*res.item['qty']+'</td></tr>');
                
            },
            error: function(xhr, ajaxOptions, thrownError) {
                toastr['error']('Update quantity failed!');
            }
        })
    });
</script>
@endsection