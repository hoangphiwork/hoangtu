@extends('frontend.layout.index')
@section('main')
<div id="wrap-inner">
	<div class="products">
		<h3>sản phẩm nổi bật</h3>
		<div class="product-list row">
			@foreach($product as $sp)
				@if($sp->status == 1 && $sp->amount > 0)
					<div class="product-item col-md-3 col-sm-6 col-xs-12">
						<img height="150px" src="upload/product/{{$sp->image}}" class="img-thumbnail">
						<p><a href="{{asset('detail/'.$sp->id.'/'.$sp->slug.'.html')}}">{{\Illuminate\Support\Str::limit($sp->name, 30)}}</a></p>
                        <p class="price">{{number_format($sp->cost,0,',','.')}} đ</p>
						<div class="marsk">
							<a href="{{route('product.show', ['slug' => $sp['slug']])}}">Xem chi tiết</a>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>

	<div id="banner-t" class="text-center">
		<div class="row">
            <div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
                <img src="upload/banner/1.png" alt="" class="img-thumbnail">
            </div>
            <div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
                <img src="upload/banner/2.png" alt="" class="img-thumbnail">
            </div>
		</div>
	</div>

	<div class="products">
		<h3>sản phẩm mới</h3>
		<div class="product-list row">
			@foreach($product_new as $sp)
				@if($sp->status == 1)
					<div class="product-item col-md-3 col-sm-6 col-xs-12">
						<img height="150" src="upload/product/{{$sp->image}}" class="img-thumbnail">
						<div>
							<p>{{\Illuminate\Support\Str::limit($sp->name, 30)}}</p>
                            @if($sp['amount'] <= 0)
								<p class="price">Tạm hết hàng</p>
                            @elseif($sp['amount'] > 0)
                                <p class="price">{{number_format($sp->cost,0,',','.')}} đ</p>
							@endif
						</div>
						<div class="marsk">
							<a href="{{route('product.show', ['slug' => $sp['slug']])}}">Xem chi tiết</a>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
<div class="mt-5 mb-3 text text-center">
		<a class="p-3 rounded text-white bg-dark" href="{{route('product.all')}}">Hiển Thị Tất Cả Sản Phẩm</a>
	</div>
@endsection

@section('title')
<title>Hoàng Tú - Phụ kiện máy tính</title>
@endsection
