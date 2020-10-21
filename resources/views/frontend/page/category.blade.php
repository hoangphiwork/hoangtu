@extends('frontend.layout.index')
@section('main')
<div id="wrap-inner">
	<div class="products">
		<h3>{{$category->name}}</h3>
		<div class="product-list row">
			@foreach($products as $sp)
			<div class="product-item col-md-3 col-sm-6 col-xs-12">
				<img height="150px" src="upload/product/{{$sp->image}}" class="img-thumbnail">
				<p>{{\Illuminate\Support\Str::limit($sp->name,30)}}</p>
                @if($sp['amount'] <= 0)
					<p class="price">Tạm hết hàng</p>
                @elseif($sp['amount'] > 0)
                    <p class="price">{{number_format($sp->cost,0,',','.')}} đ</p>
                @endif
				<div class="marsk">
					<a href="{{route('product.show', ['slug' => $sp['slug']])}}">Xem chi tiết</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>

	<div id="pagination" class="pagination justify-content-center pagination-lg">
		{{$products->links()}}
	</div>
</div>
@endsection
@section('title')
<title>{{$category->name}} - Hoàng Tú | Phụ kiện máy tính, đổ mực máy in ...</title>
@endsection
