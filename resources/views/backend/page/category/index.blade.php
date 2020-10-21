@extends('backend.layout.index')
@section('title')
    @lang('title.category.index') - @lang('app.app_title')
@endsection
@section('main')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">@lang('sidebar.category')</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">@lang('sidebar.dashboard')</a></li>
                                <li class="breadcrumb-item active">@lang('sidebar.category')</li>
                            </ol>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(session('notice'))
                <div class="alert alert-success text-center">
                    {{session('notice')}}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                <thead>
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($categories as $ct)
                                    <tr class="text-center">
                                        <td><?php echo $i++; ?></td>
                                        <td>{{$ct->name}}</td>
                                        <td>{{$ct->description}}</td>
                                        @if($ct->status == 1)
                                            <td><i class="mdi mdi-check-circle-outline text-success"></i> Đang kinh doanh</td>
                                        @else
                                            <td><i class="mdi mdi-close-circle-outline text-danger"></i> Ngừng kinh doanh</td>
                                        @endif
                                        <td>
                                            <a href="javascript:void(0);" onclick="$(this).find('form').submit();" >
                                                <form action="{{ route('category.destroy', ['category' => $ct->id]) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                                <i class="mdi mdi-delete-sweep text-danger"></i><span> @lang('button.delete') </span>
                                            </a>
                                            <a href="{{route('category.edit', ['category' => $ct->id])}}" style="margin-left: 10px;" class="text-dark"><i class="far fa-edit text-success"></i><span class=""> @lang('button.edit') </span></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>
@endsection
