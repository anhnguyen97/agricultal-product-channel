@extends('admin.layouts.master')
@section('css')

<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admins/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admins/dist/css/AdminLTE.min.css') }}">
<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{ asset('admins/dist/css/skins/_all-skins.min.css') }}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection
@section('function')
QUẢN LÝ ADMIN
@endsection
@section('content')
{{-- expr --}}
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<a href="{{ asset('admin/admin-account/') }}" title=""></a>
				<div class="box-header">
					<h3 {{-- class="box-title" --}}>List of Admin<a data-toggle="modal" href='#modalAddAdmin' class="fa fa-plus-square" style="float: right; color: green"> Admin</a></h3>

					{{-- // modal add new admin --}}
					
					<div class="modal fade" id="modalAddAdmin">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title text-uppercase"><b>Add new Admin account</b></h4>
								</div>
								<div class="modal-body">
									<form action="{{ asset('admin/admin-account/store') }}" method="POST" role="form" id="formAddAdmin">
										@csrf

										<div class="form-group">
											<label for="">Name</label>
											<input type="text" class="form-control" id="name" placeholder="Input admin's name">
										</div>
										<div class="form-group">
											<label for="">Email</label>
											<input type="email" class="form-control" id="email" placeholder="Input email">
										</div>
										<div class="form-group">
											<label for="">Password</label>
											<input type="password" class="form-control" id="password" placeholder="Input password" minlength="5">
										</div>
										<div class="form-group">
											<label for="">Password confirm</label>
											<input type="password" class="form-control" id="password_confirm" placeholder="Input password confirm">
										</div>
										<div class="form-group">
											<label for="">Avatar</label>
											<input type="file" class="form-control" id="avatar">
											{{-- <div class="input-group">
												<span class="input-group-btn">
													<a id="lfm-avatar" data-input="avatar" data-preview="holder" class="btn btn-primary">
														<i class="fa fa-picture-o"></i> Choose
													</a>
												</span>
												<input id="avatar" class="form-control" type="text" name="filepath">
											</div>
											<img id="holder" style="margin-top:15px;max-height:100px;"> --}}
										</div>
										<div class="form-group">
											<label for="">Mobile</label>
											<input type="number" class="form-control" id="mobile" minlength="10" min="100000000" maxlength="15">
										</div>
										<div class="form-group">
											<label for="">Address</label>
											<textarea class="form-control" id="address" placeholder="Input address"></textarea>
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
					<!--/. end Modal add new admin -->	
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<table id="tableAdmin" class="table table-bordered table-striped text-center">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th class="text-center" >Avatar</th>
								<th class="text-center" >Name</th>
								<th class="text-center" >Email</th>
								<th class="text-center" >Mobile</th>
								<th class="text-center" >Address</th>
								<th class="text-center" >Joined at</th>
								<th class="text-center" >Lastest updated</th>
								<th class="text-center" width="15%">Action</th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Account</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="formUpdateAdmin">
					<input type="hidden" name="edit-id" value="" id="edit-id">
					@method('PUT')
					@csrf
					<div class="form-group">
						<label for="">Name</label>
						<input type="text" class="form-control" id="edit-name">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input type="email" class="form-control" id="edit-email">
					</div>
					{{-- <div class="form-group">
						<label for="">Avatar</label>
						<input type="file" class="form-control" id="edit-avatar">
					</div> --}}
					<div class="form-group">
						<label for="">Mobile</label>
						<input type="number" class="form-control" id="edit-mobile" minlength="10" min="100000000" maxlength="15">
					</div>
					<div class="form-group">
						<label for="">Address</label>
						<textarea class="form-control" id="edit-address"></textarea>
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
<!--/. end Modal EDIT -->

<!--MODAL LIST PRODUCT Group by Brand -->
{{-- <div class="modal fade" id="modalListProduct">
	<div class="modal-dialog" style="width: 1200px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">List product group by Brand: <span id="filter_admin_id"></span> </h4>
			</div>
			<div class="modal-body">
				<table id="tableListProduct" class="table table-bordered table-striped text-center tableListProduct">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th>Thumbnail</th>
							<th>Name</th>
							<th>Brand</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Lastest updated</th>
							<th width="15%">Action</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> --}}
<!--end modal List product -->
@endsection

@section('js')
{{-- expr --}}

<!-- jQuery 3 -->
<script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
{{-- <script src="{{ asset('admins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> --}}
<!-- FastClick -->
{{-- <script src="{{ asset('admins/bower_components/fastclick/lib/fastclick.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('admins/dist/js/adminlte.min.js') }}"></script>
{{-- <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script> --}}
<!-- page script -->
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// $('#lfm-avatar').filemanager('file');

	$(function () {
		$('#tableAdmin').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.admin.getData') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'avatar', name: 'avatar', render: function(data, type, full, meta){
				return '<img src=\"http://agri.me/'+data+'" class="img-circle" height="80px" width="80px">'}
			},
			{ data: 'name', name: 'name' },
			{ data: 'email', name: 'email' },
			{ data: 'mobile', name: 'mobile' },
			{ data: 'address', name: 'address'},
			{ data: 'created_at', name: 'created_at' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	$('#formAddAdmin').on('submit', function(event){
		event.preventDefault();
		var avatar = $('#avatar').get(0).files[0];
		var formData = new FormData();
		formData.append('name', $('#name').val());
		formData.append('email', $('#email').val());
		formData.append('password', $('#password').val());
		formData.append('password_confirm', $('#password_confirm').val());
		formData.append('mobile', $('#mobile').val());
		formData.append('address', $('#address').val());
		formData.append('avatar', avatar);
		$.ajax({
			url: '{{ route('admin.admin.store') }}',
			type: 'POST',			
			data: formData,
			processData: false,
			contentType: false,
			success: function(res){
				$('#modalAddAdmin').modal('hide');
				toastr['success']('Add new Admin successfully!');
				$('#tableAdmin').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td><img src=\"http://agri.me/'+res.avatar+'" class="img-circle" height="80px" width="80px"></td><td>'+res.name+'</td><td>'+res.email+'</td><td>'+res.contact.mobile+'</td><td>'+res.contact.address+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td><a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id="'+res.id+'"></a></td></tr>');
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show admin detail to update
	$('#tableAdmin').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}admin/admin-account/edit/'+id,
			type: 'GET',
			success: function(res){
				console.log(res);
				$('#modalEdit').modal('show');
				$('#edit-name').attr('value',res.name);
				$('#edit-mobile').attr('value',res.contact.mobile);
				$('#edit-email').attr('value',res.email);
				$('textarea#edit-address').val(res.contact.address);
				$('#edit-id').attr('value',res.id);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display this admin to edit');
			}
		})
	});

	// update admin
	$('#formUpdateAdmin').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/admin-account/update/'+id,
			type: 'PUT',
			data: {
				name: $('#edit-name').val(),
				mobile: $('#edit-mobile').val(),
				email: $('#edit-email').val(),
				address: $('textarea#edit-address').val(),
			},
			success: function(res){
				$('#modalEdit').modal('hide');
				var row = document.getElementById('row-'+res.id);
				// alert('row');
				row.remove();
				toastr['success']('Update Account: '+res.name+' successfully!');
				$('#tableAdmin').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td><img src=\"http://agri.me/'+res.avatar+'" class="img-circle" height="80px" width="80px"></td><td>'+res.name+'</td><td>'+res.email+'</td><td>'+res.contact.mobile+'</td><td>'+res.contact.address+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td><a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id="'+res.id+'"></a></td></tr>');
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	});

	//delete admin
	$('#tableAdmin').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this account!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}admin/admin-account/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						console.log(res);
						if(res == "success") {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "The admin has been deleted!",
								icon: "success",
							});
						}						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Delete this admin failed!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "The admin is safety!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>
@endsection