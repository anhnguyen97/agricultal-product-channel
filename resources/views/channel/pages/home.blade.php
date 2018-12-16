
<div class="container" style="margin-top: 180px">
	<div class="breadcrumbs d-flex flex-row align-items-center text-center" style="margin-bottom: 10px;">
		<b class="text-uppercase">Danh mục nông sản</b>
	</div>
	<div class="row mx-auto my-auto" style="margin-top: -20px;">
		<div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
			<div class="carousel-inner w-100" role="listbox">
				@foreach ($allCategory as $key => $element)
				<div class="carousel-item @if ($key == 1) active @endif">
					<img class="d-block col-3 img-fluid" src="{{ asset('') }}storage/sliders/2.jpg">
				</div>
				@endforeach

			</div>
			<a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>	
</div>

<div class="container" style="margin-top: 50px">
	<div class="breadcrumbs d-flex flex-row align-items-center text-center" style="margin-bottom: 10px;">
		<b class="text-uppercase">Danh sách nông sản</b>
	</div>
	<div class="row" id="listProduct">
		@if (Auth::user()->is_farmer == 1)
		@foreach ($list_product as $element)
		<div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px">
			<div class="card ">
				<img class="card-img-top" src="{{ asset('') }}{{$element->thumbnail}}" alt="Card image cap" style="height: 253px">
				<div class="card-body">
					<h5 class="card-title"><a href="{{ asset('') }}product/{{$element->slug}}" title="">{{$element->name}}</a></h5>
					<p class="card-text">{{$element->description}} <a href="" title="More" style="color: blue" class="btnDetail"><i>Chi tiết</i></a></p>
				</div>
				<div class="card-footer">
					<small class="text-muted">ND: <a style="color: red" class="farmer"><i>{{$element->user->name}}</i></a></small>
				</div>
			</div>
		</div>
		@endforeach	
		<div class="container-fluid text-center col-lg-push-5">
			{{ $list_product->links() }}
		</div>
		@else
		@foreach ($list_product as $element)
		<div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 20px">
			<div class="card ">
				<img class="card-img-top" src="{{ asset('') }}{{$element->thumbnail}}" alt="Card image cap" style="height: 253px">
				<div class="card-body">
					<h5 class="card-title"><a href="{{ asset('') }}product/{{$element->slug}}" title="">{{$element->name}}</a></h5>
					<p class="card-text">{{$element->description}} <a href="" title="More" style="color: blue" class="btnDetail"><i>Chi tiết</i></a></p>
				</div>
				<div class="card-footer">
					<small class="text-muted">ND: <a style="color: red" class="farmer"><i>{{$element->user->name}}</i></a></small>
					<a type="" class="btn btn-sm btn-success btnAddCart" style="float: right; color: white" data-id="{{$element->id}}"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		@endforeach	
		<div class="container-fluid text-center col-lg-push-5">
			{{ $list_product->links() }}
		</div>	
		@endif
	</div>	
</div>
@section('js')
<script src="{{ asset('shop/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('shop/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('shop/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('#listProduct').on('click', '.btnAddCart', function(event){
		event.preventDefault();
		/* Act on the event */
		var id = $(this).data('id');

		$.ajax({
			url: '{{ asset('') }}trader/order/'+id,
			type: 'GET',
			success: function(res){
				toastr['success']('Thêm vào giỏ hàng thành công!');
			},
			error: function(xhr, ajaxOptions, thrownError){
				toastr['error']('Xảy ra lỗi khi thêm sản phẩm vào giỏ hàng');
			}
		})
	})
</script>
@endsection