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
				<li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i>Thống kế doanh số</a></li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
				<div class="form-input">
					<form class="form-inline" id="frmSales" name="frmSales" method="POST">
						@csrf
						<div class="form-group" style="padding: 10px 20px 10px 0px">
							<label for="date_from" style="padding: 0px 20px">Từ ngày</label>
							<input type="date" class="form-control" name="date_from" id="date_from">
						</div>
						<div class="form-group" style="padding: 10px 20px">
							<label for="date_to" style="padding: 0px 20px">Đến ngày</label>
							<input type="date" class="form-control" name="date_to" id="date_to">
						</div>
						<button type="submit" class="btn btn-primary btnPS">Thống kê</button>
					</form>
				</div>
				<div class="chart">
					<canvas id="chartSales" width="1000" height="500"></canvas>
				</div>
			</div>

		</div>
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
<script type="text/javascript" src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/bower_components/bootstrapv4.0/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('shop/js/single_custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<<script src="{{ asset('vendor/Chart.min.js') }}"></script>

<script>

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#myTab a').on('click', function (e) {
		e.preventDefault()
		$(this).tab('show')
	});

	//thống kê nông sản
	$('#frmSales').on('submit', function(event){
		event.preventDefault();

		$.ajax({
			url: '{{ route('farmer.statistical.sales') }}',
			type: 'POST',
			data: {
				date_from: $('#date_from').val(),
				date_to: $('#date_to').val(),
			},
			success: function(res){
				var ctx = document.getElementById("chartSales");
				console.log(res);
				
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: res.list_date,
						datasets: [
						{
							label: 'Doanh số',
							backgroundColor: 'rgba(10, 20, 30, 0.35)',
							borderColor: 'rgba(10, 20, 30, 1)',
							borderWidth: 1,
							hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
							hoverBorderColor: 'rgba(200, 200, 200, 1)',
							data: res.list_total,		
						}],						
					},
					option: {
						title: {
							display: true,
							position: "top",
							title: "Thống kê doanh số",
							fontSize: 18,
							fontColor: "#111",
						},
						legend: {
							display: true,
							position: "bottom",
						},
						options: {
							scales: {
								yAxes: [{
									ticks: {
										beginAtZero:true
									}
								}]
							}
						}
					}
				});
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Gặp sự cố khi thống kê doanh số');
			}
		})
	})
</script>

@endsection
