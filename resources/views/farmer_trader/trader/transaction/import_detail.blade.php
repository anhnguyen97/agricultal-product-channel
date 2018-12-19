@extends('channel.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap4.1/bootstrap.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- DataTables -->
{{-- <link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap4.1/bootstrap.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!--===============================================================================================-->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_responsive.css') }}"> --}}
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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Chi tiết Giao dịch Nhập Nông sản</a></li>
			</ul>
		</div>
		<ul>
			<li>
				<a class="btn btn-primary" data-toggle="collapse" href="#collsapseTran" role="button" aria-expanded="false"  style="margin: 20px 0px">
					Thông tin đơn hàng
				</a>
				<div class="collapse" id="collsapseTran">
					<div class="card card-body">
						<ul>
							<li>
								<b>Thông tin giao dịch</b>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Mã giao dịch:</td>
											<td>{{$trans_info->id}}</td>
										</tr>
										<tr>
											<td>Tổng tiền: </td>
											<td>{{$trans_info->total}} VNĐ</td>
										</tr>
										<tr>
											<td>Trạng thái thanh toán:</td>
											<td>@if ($trans_info->payment==0)
												"Chưa thanhh toán"
												@else "Đã thanh toán"
											@endif</td>
										</tr>
										<tr>
											<td>Trạng thái đơn hàng:</td>
											<td>@if ($trans_info->status==0)
												"Chưa hoàn thành/ Chưa được xử lý"
												@else "Đã hoàn thành"
											@endif</td>
										</tr>
									</tbody>
								</table>
							</li>
							<li><b>Nguồn hàng: </b> 
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Nông dân:</td>
											<td>{{$farmer->name}}</td>
										</tr>
										<tr>
											<td>Tài khoản:</td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</li>
							<li><b>Thông tin nhận hàng: </b>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Họ tên:</td>
											<td>{{$receiver->name}}</td>
										</tr>
										<tr>
											<td>Số điện thoại:</td>
											<td>{{$receiver->mobile}}</td>
										</tr>
										<tr>
											<td>Địa chỉ giao hàng: </td>
											<td>{{$receiver->address}}</td>
										</tr>
									</tbody>
								</table>
							</li>
						</ul>						
					</div>
				</div>
			</li>
			<li>
				<a class="btn btn-primary" data-toggle="collapse" href="#collapseTranDetail" role="button" aria-expanded="false" aria-controls="collapseTrader" style="margin: 20px 0px">
					Thông tin chi tiết đơn hàng
				</a>
				<div class="collapse" id="collapseTranDetail">
					<input type="hidden" name="tran_id" id="tran_id" value="{{$trans_info->id}}">
					<table id="tableTranDetail" class="table table-bordered text-center tableTranDetail" >
						<thead style="width: 100%">
							<tr>
								<th>Mã nông sản</th>
								<th>Ảnh</th>
								<th>Tên nông sản</th>
								<th>Số lượng</th>
								<th>Đơn vị</th>					
								<th>Giá thành</th>
								<th>Giảm giá</th>					
								<th>Thành tiền</th>
							</tr>
						</thead>
					</table>
				</div>
			</li>
		</ul>		
	</div>
</div>
</section>
<!-- /.content -->

@section('footer')
@include('channel.layouts.footer')
@endsection

@endsection


@section('js')
<!--===============================================================================================-->
{{-- <script type="text/javascript" src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!--===============================================================================================-->
{{-- <script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script> --}}
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/single_custom.js') }}"></script>

<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function () {
		var id = $('#tran_id').val();
		$('#tableTranDetail').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: {
				"url": "{{ asset('') }}trader/transaction/import_detail/getData/"+id,
				"data":{
					"tran_id": $('#tran_id').val(),
				},
			},
			columns: [
			{ data: 'product_id', name: 'product_id' },			
			{ data: 'thumbnail', name: 'thumbnail', render: function(data, type, full, meta){
				return '<img src=\"http://agri.me/'+data+'" alt="" height="80px">'} },
				{ data: 'product_name', name: 'product_name' },
				{ data: 'quantity', name: 'quantity'},
				{ data: 'unit', name: 'unit'},
				{ data: 'price', name: 'price' },
				{ data: 'discount', name: 'discount'},
				{ data: 'sum', name: 'sum' },
				],
			});
	})

	// update Product
	$('.tableTranDetail').on('click', '.btnUpdate' , function(event){
		event.preventDefault();
		var id = 'row-'+$(this).data('id');
		var row = document.getElementById(id);
		// var status = ;
		alert(status);
		$.ajax({
			url: '{{ asset('') }}product/update/'+id,
			type: 'PUT',
			data:formData,
			success: function(res){
				$('#modalEdit').modal('hide');
				var row = document.getElementById('row-'+res.id);
				console.log(res);
				row.remove();
				toastr['success']('Update Product: '+res.name+' successfully!');
				$('#tableTranDetail').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td><img src="http://agri.me/'+res.thumbnail+'" height="80px"></td><td>'+res.name+'</td><td>'+res.category_name+'</td><td>'+res.quantity+'</td><td>'+res.price+'</td><td>'+res.updated_at+'</td><td><a title="Detail" class="btn btn-info fa fa-eye btn-sm  btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnUpdate" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id="'+res.id+'"></a></td></tr>');				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	})

	//delete product
	$('.tableTranDetail').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Bạn không thể lấy lại GD sau khi xóa!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}transaction/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						console.log(res);
						if(res==1) {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "Giao dịch được xóa thành công!",
								icon: "success",
							});
						} else {
							swal({
								title: "Giao dịch không thể xóa vì chưa được hoàn thành!",
								icon: "warning",
							});
						}					
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Xóa giao dịch thất bại!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "Giao dịch được an toàn!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>

@endsection
