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
<style>
.card-block ul li{
	margin-top: 10px; 
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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Thông tin cá nhân</a></li>
			</ul>
		</div>
		<a class="btn btn-primary btnUpdateAccount" data-toggle="modal" href='#modalUpdateAccount' style="margin-bottom: 20px; float: right"><i class="fa fa-users" aria-hidden="true"> Cập nhật</i></a>
		<hr/>		
	</div>
	<hr/>	
	<div class="row">
		@if (\Session::has('success'))
		<div class="alert alert-success">
			<ul>
				<li>{!! \Session::get('success') !!}</li>
			</ul>
		</div>
		@endif
		@if (\Session::has('error'))
		<div class="alert alert-error">
			<ul>
				<li>{!! \Session::get('success') !!}</li>
			</ul>
		</div>
		@endif	
	</div>
	<div class="row">
		<div class="avatar col-2">
			<img src="http://agri.me/{!!$account->avatar!!}" class="img-circle" style="width: 150px; height:150px; border-radius: 50%">
		</div>
		<div class="card-block col-6" style="font-size: 13pt">
			<ul>
				<li><h4 class="name"><i>{{$account->name}}</i></h4></li>
				<li>
					<i class="fa fa-phone" aria-hidden="true" style="width: 20px"></i><span class="mobile"> {{$account->contact->mobile}}</span>
				</li>
				<li>
					<i class="fa fa-envelope-o" aria-hidden="true" style="width: 20px"></i><span class="email"> {{$account->email}}</span>
				</li>
				<li>
					<i class="fa fa-map-marker" aria-hidden="true" style="width: 20px"></i><span class="address"> {{$account->contact->address}}</span>
				</li>
			</ul>
		</div>			
	</div>	
</div>
</section>
<!-- /.content -->

@section('footer')
@include('channel.layouts.footer')
@endsection

{{-- MODAL ADD PRODUCT --}}
<div class="modal fade" id="modalUpdateAccount">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cập nhật thông tin tài khoản</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				
			</div>
			<div class="modal-body container-fluid">
				<form class="container-fluid" enctype="multipart/form-data" method="POST" id="formUpdateAccount" action="{{ asset('') }}profile/update/{{Auth::id()}}">
					@csrf
					<input type="hidden" name="contact_id" id="contact_id" value="{{$account->contact->id}}">
					<input type="hidden" name="user_id" id="user_id" value="{{$account->id}}">
					<div class="form-group row">
						<label for="name" class="col-sm-2 form-control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{$account->name}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="mobile" class="col-sm-2 form-control-label">Mobile</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="mobile" name="mobile" value="{{$account->contact->mobile}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-2 form-control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" value="{{$account->email}}" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-sm-2 form-control-label">Address</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="address" required name="address">{{$account->contact->address}}</textarea> 
						</div>
					</div>
					<div class="form-group row">
						<label for="avatar" class="col-sm-2 form-control-label">Thumbnail</label>
						<div class="col-sm-10">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">Upload</span>
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input form-control" name="avatar" id="avatar" >
									<label class="custom-file-label" for="avatar"></label>
									<input type="hidden" class="form-control" name="old_avatar" id="old_avatar" value="{{$account->avatar}}">
								</div>
							</div>
						</div>
					</div>	
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--/.end Modal update Account -->

@endsection


@section('js')
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>

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

</script>

@endsection
