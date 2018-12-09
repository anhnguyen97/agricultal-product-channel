@extends('channel.layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap4.1/bootstrap.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap4.1/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('shop/styles/single_responsive.css') }}">
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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Quản lý Kho</a></li>
			</ul>
		</div>{{-- 
		<a class="btn btn-primary" data-toggle="modal" href='#modalAddProduct' style="margin-bottom: 20px;"><i class="fa fa-pagelines" aria-hidden="true"> New</i></a> --}}
		
		<table id="tableProduct" class="table table-bordered table-striped text-center tableProduct" style="width:100%">
			<thead>
				<tr>
					<th width="5%">ID</th>
					<th>Thumbnail</th>
					<th>Name</th>
					<th>Category</th>
					<th>Quantity</th>
					<th>Cost</th>
					<th>Lastest updated</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</section>
<!-- /.content -->

@endsection

@section('footer')
@include('channel.layouts.footer')
@endsection

@section('js')
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net/js/dataTables.bootstrap4.min.js') }}"></script>

{{-- <script src="{{ asset('js/channel/main.js') }}"></script> --}}
{{-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}" --}}></script>
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/single_custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function () {
		$('#tableProduct').DataTable({
			processing: true,
			serverSide: true,
			destroy: true,
			ajax: '{!! route('trader.product.getData') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'thumbnail', name: 'thumbnail', render: function(data, type, full, meta){
				return '<img src=\"http://agri.me/'+data+'" alt="" height="80px">'}
			},
			{ data: 'name', name: 'name' },
			{ data: 'category', name: 'category'},
			{ data: 'quantity', name: 'quantity' },
			{ data: 'price', name: 'price' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	//delete product
	$('.tableProduct').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Bạn không thể lấy lại thông tin Sản phẩm sau khi xóa!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}trader/product/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						if(res == "success") {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "Nông sản đã bị xóa khỏi danh sách!",
								icon: "success",
							});
						}					
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Xảy ra lỗi khi xóa nông sản này!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "Nông sản được an toàn!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>

@endsection
