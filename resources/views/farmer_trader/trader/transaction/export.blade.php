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
<style type="text/css" media="screen">
#tableTransaction{
	width: 100%;
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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Quản lý Xuất hàng</a></li>
			</ul>
		</div>
		{{-- <a class="btn btn-primary" data-toggle="modal" href='#modalAddProduct' style="margin-bottom: 20px;"><i class="fa fa-pagelines" aria-hidden="true">New</i></a> --}}
		<table id="tableTransaction" class="table table-bordered text-center tableTransaction" >
			<thead style="width: 100%">
				<tr>
					<th>Mã GD</th>
					<th>Khách hàng</th>
					<th>Tổng tiền</th>					
					<th>T/trạng Thanh toán</th>
					<th>Tình trạng GD</th>					
					<th>Ngày tạo GD</th>
					<th>Cập nhật mới nhất</th>
					<th>Thao tác</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</section>
<!-- /.content -->

{{-- MODAL EDIT TRANSACTION --}}
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Update transaction</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="formUpdateTransaction" name="formUpdateTransaction">
					@csrf					
					<input type="hidden" name="edit-id" value="" id="edit-id">			
					<div class="form-group">
						<label for="">Tình trạng thanh toán</label>
						<select name="edit-payment" class="form-control" id="edit-payment">
							<option value="1">Đã thanh toán</option>
							<option value="0">Chưa thanh toán</option>
						</select>
					</div>	
					<div class="form-group">
						<label for="">Tình trạng giao dịch</label>
						<select name="edit-status" class="form-control" id="edit-status">
							<option value="1">Đã hoàn thành</option>
							<option value="0">Đang xử lý</option>
							<option value="2">Đã xử lý/ Đang giao hàng</option>
						</select>
					</div>	
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>	
				</form>
			</div>			
		</div>
	</div>
</div>

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
		$('#tableTransaction').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: '{!! route('trader.transaction.getDataExport') !!}',
			columns: [
			{ data: 'id', name: 'id' },			
			{ data: 'contact_id', name: 'contact_id' },
			{ data: 'total', name: 'total' },
			{ data: 'payment', name: 'payment', render: function(data, type, full, meta){
				if (data == 1) {
					return 'Đã thanh toán';
				} else {
					return 'Chưa thanh toán';
				}
			}},
			{ data: 'status', name: 'status', render: function(data, type, full, meta){
				if (data == 1) {
					return 'Đã hoàn thành';
				} else if(data == 0) {
					return 'Đang giao hàng';
				} else {
					return 'Đã hoàn thành';
				}
			}},
			{ data: 'created_at', name: 'created_at' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	// show Transaction detail to update
	$('.tableTransaction').on('click', '.btnUpdate', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}trader/transaction/edit/'+id,
			type: 'GET',
			success: function(res){
				console.log(res);
				$('#modalEdit').modal('show');
				$('#edit-id').attr('value',res.id);
				$('#edit-status option[value="'+res.status+'"]').prop('selected', true);
				$('#edit-payment option[value="'+res.payment+'"]').prop('selected', true);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display Product to edit');
			}
		})
	});

	// update Product
	$('#formUpdateTransaction').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		$.ajax({
			url: '{{ asset('') }}trader/transaction/update/'+id,
			type: 'POST',
			data : {
				status: $('#edit-status').val(),
				payment: $('#edit-payment').val(),
			},		
			success: function(res){
				console.log(res);
				$('#modalEdit').modal('hide');
				console.log(res);
				if (res.error != null) {
					toastr['error'](res.error);
				} else {
					var row = document.getElementById('row-'+res.id);
					row.remove();
					toastr['success']('Update transactions successfully!');
					$('#tableTransaction').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td>'+res.trader+'</td><td>'+res.total+'</td><td>'+res.payment+'</td><td>'+res.status+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td><a title="Detail" href="http://agri.me/trader/transaction/'+res.id+'" class="btn btn-info btn-sm fa fa-eye btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm fa fa-pencil btnUpdate" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id='+res.id+'></a></td></tr>');	
				}				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	})

	//delete transaction
	$('.tableTransaction').on('click', '.btnDelete', function(event) {
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
					url: '{{ asset('') }}trader/transaction/delete/'+id,
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
