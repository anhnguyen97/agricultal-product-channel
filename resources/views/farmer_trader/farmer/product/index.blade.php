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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Quản lý Nông sản</a></li>
			</ul>
		</div>
		<a class="btn btn-primary" data-toggle="modal" href='#modalAddProduct' style="margin-bottom: 20px;"><i class="fa fa-pagelines" aria-hidden="true"> New</i></a>
		
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

@section('footer')
	@include('channel.layouts.footer')
@endsection

{{-- MODAL ADD PRODUCT --}}
<div class="modal fade" id="modalAddProduct">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Thêm nông sản mới</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				
			</div>
			<div class="modal-body container-fluid">
				<form class="container-fluid" method="POST" id="formAddProduct">
					@csrf
					
					<div class="form-group row">
						<label for="inputName" class="col-sm-2 form-control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputName" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputDescription" class="col-sm-2 form-control-label">Description</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputDescription">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputContent" class="col-sm-2 form-control-label">Content</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="inputContent" name="inputContent"></textarea> 
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Category</label>
						<div class="col-sm-10">
							<select class="custom-select" id="inputCategory">
								@foreach ($allCategory as $category)
								<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach								
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputThumbnail" class="col-sm-2 form-control-label">Thumbnail</label>
						<div class="col-sm-10">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="inputThumbnail" aria-describedby="inputThumbnail">
									<label class="custom-file-label" for="inputThumbnails">Choose file</label>
								</div>
							</div>
						</div>
					</div>			
					<div class="form-group row">
						<label for="inputQuantity" class="col-sm-2 form-control-label">Quantity</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="inputQuantity">
						</div>
					</div>
					<div class="form-group row">
						<label for="inputPrice" class="col-sm-2 form-control-label">Price</label>
						<div class="col-sm-10">
							{{-- <input type="number" class="form-control" id="inputQuantity"> --}}
							<div class="input-group">
								<input type="number"  id="inputPrice" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
								<div class="input-group-append">
									<span class="input-group-text">VNĐ</span>
									<span class="input-group-text">0.00</span>
								</div>
							</div>
						</div>
					</div>				
					<div class="form-group row">
						<label for="inputDiscount" class="col-sm-2 form-control-label">Discount</label>
						<div class="col-sm-10">
							{{-- <input type="number" class="form-control" id="inputDiscount"> --}}							
							<div class="input-group">
								<input type="number" id="inputDiscount" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
								<div class="input-group-append">
									{{-- <span class="input-group-text">VNĐ</span> --}}
									<span class="input-group-text">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/.end Modal add Product -->

<!--/ MODAL SHOW PRODUCT DETAILs-->
<div class="modal fade" id="modalShow">
	<div class="modal-dialog" style="width: 600px;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Thông tin chi tiết nông sản <span id="product_name"></span></h4>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<tr>
						<td colspan="2" class="text-center">
							<img src="" class="img-responsive text-center align-items-lg-center" id="show-thumbnail" alt="Image" width="300px">
						</td>
					</tr>
					<tr>
						<td colspan="2" rowspan="" headers=""></td>
					</tr>
					<tr>
						<td colspan="2"><h3><div id="show-name" ></div></h3></td>
					</tr>
					<tr>
						<td colspan="2">
							<div id="show-category-name"></div>
							<div id="show-description"></div>
							<div id="show-content"></div>
						</td>
					</tr>
					<tr>
						<td class="field">Sản lượng: </td>
						<td><div id="show-quantity">&nbsp;<span id="show-unit"></span></div></td>
					</tr>					
					<tr>
						<td class="field">Gía gốc: </td>
						<td><div id="show-price"></div></td>
					</tr>
					<tr>
						<td class="field">Giảm giá: </td>
						<td><div id="show-discount"></div></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<!--/ MODAL UPDATE PRODUCT-->
<div class="modal fade" id="modalEdit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cập nhật nông sản</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				
			</div>
			<div class="modal-body">
				<form class="container-fluid" method="POST" id="formUpdateProduct">
					@method('PUT')
					@csrf
					

					<input type="hidden" name="editId" id="editId" value="">
					<div class="form-group row">
						<label for="editName" class="col-sm-2 form-control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="editName">
						</div>
					</div>
					<div class="form-group row">
						<label for="editDescription" class="col-sm-2 form-control-label">Description</label>
						<div class="col-sm-10">
							<textarea name="editDescription" class="form-control" id="editDescription"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="editContent" class="col-sm-2 form-control-label">Content</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="editContent" name="editContent"></textarea> 
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-2 form-control-label">Category</label>
						<div class="col-sm-10">
							<select class="custom-select" id="editCategory">
								@foreach ($allCategory as $category)
								<option value="{{$category->id}}">{{$category->name}}</option>
								@endforeach								
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="editThumbnail" class="col-sm-2 form-control-label">Thumbnail</label>
						<div class="col-sm-10">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="editThumbnail" aria-describedby="editThumbnail">
									<label class="custom-file-label" for="editThumbnail">Choose file</label>
								</div>
							</div>
							<img src="" class="img-fluid img-thumbnail" alt="Responsive image" id="displayThumbnail" style="width: 150px; height: auto">
						</div>
					</div>			
					<div class="form-group row">
						<label for="editQuantity" class="col-sm-2 form-control-label">Quantity</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="editQuantity">
						</div>
					</div>
					<div class="form-group row">
						<label for="editPrice" class="col-sm-2 form-control-label">Price</label>
						<div class="col-sm-10">
							<div class="input-group">
								<input type="number"  id="editPrice" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
								<div class="input-group-append">
									<span class="input-group-text">VNĐ</span>
									<span class="input-group-text">.00</span>
								</div>
							</div>
						</div>
					</div>				
					<div class="form-group row">
						<label for="editDiscount" class="col-sm-2 form-control-label">Discount</label>
						<div class="col-sm-10">						
							<div class="input-group">
								<input type="number" id="editDiscount" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
								<div class="input-group-append">
									<span class="input-group-text">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
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
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="{{ asset('shop/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
<script src="{{ asset('shop/js/single_custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

<script>
	var options = {
		filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
		filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
		filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
		filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
	};
	CKEDITOR.replace( 'inputContent', options );
	CKEDITOR.replace( 'editContent', options );
	// $('#inputThumbnail').filemanager('images');
	// $('#inputThumbnail').filemanager('image', {prefix: 'laravel-filemanager'});
</script>
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
			ajax: '{!! route('farmer.product.getData') !!}',
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

	//add new product
	$('#formAddProduct').on('submit', function(event){
		event.preventDefault();
		var thumbnail = $('#inputThumbnail').get(0).files[0];
		var content = CKEDITOR.instances.inputContent.getData();
		var formData = new FormData();
		console.log(formData);
		formData.append('name', $('#inputName').val());
		formData.append('category_id', $('#inputCategory option:selected').val());
		formData.append('quantity', $('#inputQuantity').val());
		formData.append('price', $('#inputPrice').val());
		formData.append('discount', $('#inputDiscount').val());
		formData.append('content', content);
		formData.append('description', $('#inputDescription').val());
		formData.append('thumbnail', thumbnail);
		// console.log(formData);
		$.ajax({
			url: '{{ route('farmer.product.store') }}',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(res){
				$('#modalAddProduct').modal('hide');
				toastr['success']('Add new Product successfully!');
				$('#tableProduct').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td><img src="http://agri.me/'+res.thumbnail+'" height="80px"></td><td>'+res.name+'</td><td>'+res.category_name+'</td><td>'+res.quantity+'</td><td>'+res.price+'</td><td>'+res.updated_at+'</td><td><a title="Detail" class="btn btn-info fa fa-eye btn-sm  btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm fa fa-pencil btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id="'+res.id+'"></a></td></tr>');
				// console.log(res);
				document.getElementById("formAddProduct").reset();
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Add failed');
			}
		})
	})

	// show Product detail to update
	$('.tableProduct').on('click', '.btnEdit', function(event) {
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');
		
		$.ajax({
			url: '{{ asset('') }}farmer/product/edit/'+id,
			type: 'GET',
			success: function(res){
				console.log(res);
				$('#modalEdit').modal('show');
				$('#editId').attr('value',res.id);
				$('#editName').attr('value',res.name);
				$('#editQuantity').attr('value',res.quantity);
				$('#editPrice').attr('value',res.price);
				$('#editDiscount').attr('value',res.discount);
				CKEDITOR.instances['editContent'].setData(res.content);
				$('textarea#editDescription').val(res.description);
				$('#editCategory option[value="'+res.category_id+'"]').prop('selected', true);
				$('#displayThumbnail').attr('src', 'http://agri.me/'+res.thumbnail);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Can\'t display Product to edit');
			}
		})
	});

	//show Product detail
	$('.tableProduct').on('click', '.btnShow', function(event){
		event.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: '{{ asset('') }}farmer/product/show_pro/'+id,
			type: 'GET',
			success: function(res){
				console.log(res);
				$('#modalShow').modal('show');
				// $('#product_name').text(res.name);
				// $('#show-name').text(res.name);
				// $('#show-category-name').text(res.category.name);
				// $('#show-description').text(res.description);
				// $('#show-content').text(res.content);
				// $('#show-discount').text(res.discount+ " %");
				// $('#show-price').text(res.price+ "VNĐ");
				// $('#show-quantity').text(res.quantity);
				// $('#show-unit').text(res.unit);
				// $('#show-thumbnail').attr('src', "http://agri.me/"+res.thumbnail);
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Load Product failed');
			}
		})
	})

	// update Product
	$('#formUpdateProduct').on('submit', function(event){
		event.preventDefault();
		var id = $('#edit-id').val();
		var thumbnail = $('#edit-thumbnail').get(0).files[0];
		var content = CKEDITOR.instances['editContent'].getData();
		var formData = new FormData();
		formData.append('name', $('#edit-name').val());
		formData.append('category_id', $('#edit-category option:selected').val());
		formData.append('quantity', $('#edit-quantity').val());
		formData.append('price', $('#edit-price').val());
		formData.append('discount', $('#edit-discount').val());
		formData.append('content', content);
		formData.append('description', $('#edit-description').val());
		formData.append('thumbnail', thumbnail);
		$.ajax({
			url: '{{ asset('') }}farmer/product/update/'+id,
			type: 'PUT',
			data:formData,
			success: function(res){
				$('#modalEdit').modal('hide');
				var row = document.getElementById('row-'+res.id);
				console.log(res);
				row.remove();
				toastr['success']('Update Product: '+res.name+' successfully!');
				$('#tableProduct').prepend('<tr id="row-'+res.id+'" role="row"><td>'+res.id+'</td><td><img src="http://agri.me/'+res.thumbnail+'" height="80px"></td><td>'+res.name+'</td><td>'+res.category_name+'</td><td>'+res.quantity+'</td><td>'+res.price+'</td><td>'+res.updated_at+'</td><td><a title="Detail" class="btn btn-info fa fa-eye btn-sm  btnShow" data-id="'+res.id+'" id="row-'+res.id+'"></a>&nbsp;<a title="Edit" class="btn btn-warning btn-sm fa fa-pencil btnEdit" data-id="'+res.id+'"></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm fa fa-trash-o btnDelete" data-id="'+res.id+'"></a></td></tr>');				
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Edit failed!');
			}
		})
	})

	//delete product
	$('.tableProduct').on('click', '.btnDelete', function(event) {
		event.preventDefault();
		var id = $(this).data('id');

		swal({
			title: "Are you sure?",
			text: "Once deleted, you will not be able to recover this Product!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: '{{ asset('') }}farmer/product/delete/'+id,
					type: 'DELETE',
					dataType:"json",
					success: function(res){
						if(res == "success") {
							var row = document.getElementById('row-'+id);
							row.remove();
							swal({
								title: "The products has been deleted!",
								icon: "success",
							});
						}					
					},
					error: function(xhr, ajaxOptions, thrownError) {
						swal({
							title: "Delete this product failed!",
							icon: "error",
						});
					}
				})
			} else {
				swal({
					title: "The product is safety!",
					icon: "success",
					button: "OK!",
				});
			}
		});
	});

</script>

@endsection