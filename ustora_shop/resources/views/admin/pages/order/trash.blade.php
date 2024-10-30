@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Danh sách thùng rác</div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table
                    id="basic-datatables"
                    class="display table table-striped table-bordered"
                  >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ảnh</th>
                      <th>Tên sản phẩm</th>
                      <th>Danh mục</th>
                      <th>Giảm giá %</th>
                      {{-- <th>Mô tả sản phẩm</th> --}}
                      <th>Giá sản phẩm</th>
                      <th>Tag</th>
                      <th>Slug</th>
                        <th>Ngày tạo</th>
                        <th>Ngày xoá</th>
                      <th class="text-center">Action</th>

                    </tr>
                  </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giảm giá %</th>
                        {{-- <th>Mô tả sản phẩm</th> --}}
                        <th>Giá sản phẩm</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>Ngày tạo</th>
                        <th>Ngày xoá</th>
                        <th class="text-center">Action</th>

                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($products as $product)
                      <tr>
                        <td>{{$product->id}}</td>
                        <td>
                          <img src="{{asset('storage/images')}}/{{$product->img}}" width="100px" alt="">
                        </td>
                        <td>{{$product->name}}</td>

                        <td>{{$product->category? $product->category->name : 'Không có danh mục'}}</td>
                        <td>{{$product->discount}}%</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->tag}}</td>
                        <td>{{$product->slug}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->deleted_at}}</td>
                        <td class="d-flex gap-1 justify-content-around">
                            <a href="{{route('product.restore',$product->id)}}" class="btn btn-primary p-2">
                                <i class="fas fa-redo"></i>
                                Khôi phục
                            </a>
                            <a href="{{route('product.forceDelete',$product->id)}}" class="btn btn-danger p-2" onclick="return comfirm('Bạn có chắc chắn xoá vĩnh viễn ?');">
                                <i class="fas fa-trash-alt"></i>
                                Xoá vĩnh viễn
                            </a>
                        </td>
                      </tr>

                      @endforeach

                    </tbody>
                  </table>
                  <div class="form-group">
                    <a href="{{route('product.index')}}" class="btn btn-black">Trở lại</a>
                  </div>
                </div>
              </div>
    </div>
</div>

@endsection
