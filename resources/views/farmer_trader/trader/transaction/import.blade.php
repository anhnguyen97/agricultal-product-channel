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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Quản lý Nhập hàng</a></li>
			</ul>
		</div>
		<a class="btn btn-primary" href='{{ route('channel.home') }}' style="margin-bottom: 20px;"><i class="fa fa-pagelines" aria-hidden="true"> Nhập nông sản mới</i></a>
		<table id="tableTransaction" class="table table-bordered text-center tableTransaction" >
			<thead style="width: 100%">
				<tr>
					<th>Mã GD</th>
					<th>Nguồn nông sản</th>
					<th>Lượng GD</th>					
					<th>Thanh toán</th>
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
			ajax: '{!! route('trader.transaction.getDataImport') !!}',
			columns: [
			{ data: 'id', name: 'id' },			
			{ data: 'farmer_id', name: 'farmer_id' },
			{ data: 'total', name: 'total' },
			{ data: 'payment', name: 'payment'},
			{ data: 'status', name: 'status'},
			{ data: 'created_at', name: 'created_at' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
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
