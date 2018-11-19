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
QUẢN LÝ DANH MỤC NÔNG SẢN
@endsection
@section('content')
{{-- expr --}}
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<a href="{{ asset('admin/category/') }}" title=""></a>
				<div class="box-header">
					<h3 {{-- class="box-title" --}}>List category<a data-toggle="modal" href='#modalAddCategory' class="fa fa-plus-square" style="float: right; color: green"> new category</a></h3>

					<div class="modal fade" id="modalAddCategory">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Add new category</h4>
								</div>
								<div class="modal-body">
									<form action="{{ asset('admin/category/store') }}" method="POST" role="form" id="formAddCategory">
										@csrf

										<div class="form-group">
											<label for="">Category's name</label>
											<input type="text" class="form-control" id="name" placeholder="Input category's name">
										</div>
										<div class="form-group">
											<label for="">Desciption</label>
											<textarea class="form-control" id="description" placeholder="Input category's description"></textarea>
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
					<!--/. end Modal add new category -->	
				</div>
				<!-- /.box-header -->

				<div class="box-body">
					<table id="tableCategory" class="table table-bordered table-striped text-center">
						<thead>
							<tr>
								<th width="5%" class="text-center">ID</th>
								<th class="text-center" >Name</th>
								<th class="text-center" >Description</th>
								<th class="text-center" >Created at</th>
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
				<h4 class="modal-title">Edit Category</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form" id="formUpdateCategory">
					@method('PUT')
					@csrf

					<input type="text" class="form-control hidden" id="edit-id" name="edit-id">
					<div class="form-group">
						<label for="">Category's name</label>
						<input type="text" class="form-control" id="edit-name">
					</div>
					<div class="form-group">
						<label for="">Desciption</label>
						<textarea class="form-control" id="edit-description" ></textarea>
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

<!--MODAL LIST PRODUCT Group by Category -->
<div class="modal fade" id="modalListProduct">
	<div class="modal-dialog" style="width: 1200px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">List product group by Category: <span id="filter_category_id"></span> </h4>
			</div>
			<div class="modal-body">
				<table id="tableListProduct" class="table table-bordered table-striped text-center tableListProduct">
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
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
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
<!-- page script -->
<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(function () {
		$('#tableCategory').DataTable({
			processing: true,
			serverSide: true,
			ajax: '{!! route('admin.category.getData') !!}',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name' },
			{ data: 'description', name: 'desciption'},
			{ data: 'created_at', name: 'created_at' },
			{ data: 'updated_at', name: 'updated_at' },
			{ data: 'action', name: 'action', orderable: false, searchable: false},
			],
		});
	})

	$('#formAddCategory').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url: '{{ route('admin.category.store') }}',
			type: 'POST',
			data: {
				name: $('#name').val(),
				description: $('#description').val(),
			},
			success: function(res){
				$('#modalAddCategory').modal('hide');
				toastr['success']('Add new Category successfully!');
				$('#tableCategory').prepend('<tr id="row-'+res.id+'"><td width="5%" class="text-center">'+res.id+'</td><td class="text-left">'+res.name+'</td><td>'+res.description+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td class="text-center" width="15%" ><a title="Detail" href="http://dss.me/admin/category/"'+res.slug+'" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res.id+'></a></td></tr>');
				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show category detail to update
	$('#tableCategory').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}admin/category/edit/'+id,
			type: 'GET',
			success: function(res){
				$('#modalEdit').modal('show');
				$('#edit-name').attr('value',res.name);
				$('textarea#edit-description').val(res.description);
				$('#edit-id').attr('value',res.id);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display category to edit');
			}
		})
	});

	// update category
	$('#formUpdateCategory').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		// alert(id);
		$.ajax({
			url: '{{ asset('') }}admin/category/update/'+id,
			type: 'PUT',
			data: {
				name: $('#edit-name').val(),
				description: $('#edit-description').val(),
			},
			success: function(res){
				$('#modalEdit').modal('hide');
				var row = document.getElementById('row-'+res.id);
				// alert('row');
				row.remove();
				toastr['success']('Update Category: '+res.name+' successfully!');
				$('#tableCategory').prepend('<tr id="'+res.id+'"><td width="5%" class="text-center">'+res.id+'</td><td class="text-left">'+res.name+'</td><td>'+res.description+'</td><td>'+res.created_at+'</td><td>'+res.updated_at+'</td><td class="text-center" width="15%" ><a title="Detail" href="http://dss.me/admin/category/'+res.slug+'" class="btn btn-info btn-sm glyphicon glyphicon-list-alt btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='+res.id+'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='+res.id+'></a></td></tr>');				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	});

	//delete category
	$('#tableCategory').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Category!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}admin/category/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						console.log(res);
						if (res == 'existProduct') {
							swal({
								title:"Can't delete category",
								text: "You must delete product before deleting category.",
								icon: "warning",
							});						
						} 
						if(res == "success") {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "The category has been deleted!",
								icon: "success",
							});
						}						
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Delete this category failed!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "The category is safety!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>
@endsection