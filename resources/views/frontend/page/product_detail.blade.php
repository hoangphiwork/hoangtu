@extends('frontend.layout.index')
@section('main')
<div id="wrap-inner">
	<div id="product-info">
		<div class="clearfix"></div>
		<h3>{{$product->name}}</h3>
		<div class="row">
			<div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center mb-3">
				<img style="margin-top:10px;margin-bottom:10px;" height="100%"  width="100%" src="upload/product/{{$product->image}}">
			</div>
			<div id="product-details" class="col-xs-12 col-sm-12 col-md-9" style="padding-left: 0%;">
					<p style="margin-top: 30px;padding-bottom: 0px; margin-bottom: 0px;">Giá: <span class="price">{{number_format($product->cost)}} đ</span></p>
					@if($product->amount > 0)
						<p style="">Trạng thái: <b style="color: #00AE03">Còn hàng</b></p>
						<p class="add-cart text-center" style="width: 50%; border-radius: 8px;"><a href="{{route('cart.create', ['id' => $product->id])}}">Đặt hàng online</a></p>
					@elseif($product->amount <= 0)
						<p style="">Trạng thái: <b style="color: #A12222">Tạm hết hàng</b></p>
					@endif

			</div>
		</div>
	</div>
	<div id="product-detail">
		<h3>Chi tiết sản phẩm</h3>
		<p class="text-justify" style="line-height: 28px;">{{$product->des}}.</p>
	</div>
</div>
@endsection
@section('title')
<title>{{$product->name}}</title>
@endsection
