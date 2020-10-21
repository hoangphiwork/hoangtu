@extends('frontend.layout.index')
@section('main')
<script type="text/javascript">
	function UpDateCart(quantity,id){

		$.get('{{route('cart.update')}}',{quantity:quantity,id:id},function(){location.reload();});
	}
</script>
<div id="wrap-inner">
	<div id="list-cart">
		<h3>Giỏ hàng</h3>
		<form>
			@if (\Session::has('errorcart'))
			    <div class="alert alert-success text-center">
					<h2>{!! \Session::get('errorcart') !!}</h2>
			    </div>
			@endif
			<table class="table table-bordered .table-responsive text-center">
				<tr class="active">
					<td width="11.111%">Ảnh mô tả</td>
					<td width="22.222%">Tên sản phẩm</td>
					<td width="22.222%">Số lượng</td>
					<td width="16.6665%">Đơn giá</td>
					<td width="16.6665%">Thành tiền</td>
					<td width="11.112%">Xóa</td>
				</tr>
				@foreach(Cart::getContent() as $cart)
				<tr>
					<td ><img style="width: 100%;" class="img-responsive" src="upload/product/{{$cart->attributes->images}}"></td>
					<td>{{$cart->name}}</td>
					<td>
						<div class="form-group">
							<input class="form-control" type="number" value="{{$cart->quantity}}" onchange="UpDateCart(this.value,'{{$cart->id}}')">
						</div>
					</td>
					<td><span class="price">{{number_format($cart->price )}} đ</span></td>
					<td><span class="price">{{number_format($cart->price * $cart->quantity)}} đ</span></td>
					<td><a href="{{route('cart.destroy', ['id' => $cart->id])}}">Xóa</a></td>
				</tr>
				@endforeach
			</table>
			<div class="row" id="total-price">
				<div class="col-md-6 col-sm-12 col-xs-12">
						Tổng thanh toán: <span class="total-price">{{number_format(Cart::getTotal())}} đ</span>

				</div>
				<div class="col-md-6 col-sm-12 col-xs-12">
					<a style="width: 30%; border-color: #ebdac1; padding: 10px;" href="{{route('home')}}" class="my-btn btn">Mua tiếp</a>
					<a style="width: 30%;border-color: #ebdac1; padding: 10px;" href="{{route('cart.destroy', ['id' => 'DelAll'])}}" class="my-btn btn">Xóa giỏ hàng</a>
				</div>
			</div>
		</form>
	</div>

	<div id="xac-nhan">
		<h3>Xác nhận mua hàng</h3>
		<form action="{{route('cart.store')}}" method="post">
			@csrf
			<div class="form-group">
				<label for="name">Họ và tên:</label>
				<input required type="text" class="form-control p-3" id="name" name="name" placeholder="Nhập họ tên của bạn...">
			</div>
			<div class="form-group">
				<label for="phone">Số điện thoại:</label>
				<input required type="number" class="form-control p-3" id="phone" name="phone" placeholder="Nhập số điện thoại...">
			</div>
			<div class="form-group">
				<label for="add">Địa chỉ:</label>
				<input required type="text" class="form-control p-3" id="add" name="add" placeholder="Nhập địa chỉ bao gồm số nhà...">
			</div>
			<div class="form-group text-right">
				<button type="submit" class="btn btn-default p-3">Xác nhận mua hàng</button>
			</div>
		</form>
	</div>
</div>
@endsection
@section('title')
<title>Hoàng Tú - Giỏ hàng</title>
@endsection
