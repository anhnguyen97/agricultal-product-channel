@extends('admin.layouts.master')
@section('css')
@include('admin.layouts.css')
@endsection
@section('function')
Cập nhật thông tin tài khoản
@endsection
@section('content')
<!-- Main content -->
<section class="content">
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
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-widget widget-user">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua-active">
					<h3 class="widget-user-username">{{$account->name}}</h3>
					<h5 class="widget-user-desc">
						<a class="btn btn-success btnUpdateAccount" data-toggle="modal" href='#modalUpdateAccount' style="margin-bottom: 20px; float: right"><i class="fa fa-users" aria-hidden="true"> Cập nhật</i></a>
					</h5>
				</div>
				<div class="widget-user-image">
					<img class="img-circle" src="http://agri.me/{!!$account->avatar!!}" alt="User Avatar" style="width: 90px; height: 90px ">
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">Mobile</h5>
								<span class="description-text">{{$account->contact->mobile}}</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header">Email</h5>
								<span class="description-text">{{$account->email}}</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header">Address</h5>
								<span class="description-text">{{$account->contact->address}}</span>
							</div>
							<!-- /.description-block -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->
				</div>
			</div>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

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
				<form class="container-fluid" enctype="multipart/form-data" method="POST" id="formUpdateAccount" action="{{ asset('') }}admin/admin_profile/update/{{Auth::guard('admin')->id()}}">
					@csrf
					<input type="hidden" name="contact_id" id="contact_id" value="{{$account->contact->id}}">
					<input type="hidden" name="admin_id" id="admin_id" value="{{$account->id}}">
					<div class="form-group row">
						<label for="name" class="col-sm-2 form-control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" value="{{$account->name}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="mobile" class="col-sm-2 form-control-label">Mobile</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" id="mobile" name="mobile" value="{{$account->contact->mobile}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-2 form-control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" value="{{$account->email}}">
						</div>
					</div>
					<div class="form-group row">
						<label for="address" class="col-sm-2 form-control-label">Address</label>
						<div class="col-sm-10">
							<textarea type="text" class="form-control" id="address" name="address">{{$account->contact->address}}</textarea> 
						</div>
					</div>
					<div class="form-group row">
						<label for="avatar" class="col-sm-2 form-control-label">Thumbnail</label>
						<div class="col-sm-10">
							<div class="input-group mb-3">
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
{{-- expr --}}
@include('admin.layouts.js')
@endsection