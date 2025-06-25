@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Quản lí sản phẩm</div>
                <div class="card-tools">
                  <div class="d-flex">
                    <div class="form-group">
                      <a href="{{route('product.create')}}" class="btn btn-dark ">
                        <i class="fas fa-plus"></i>
                        Thêm sản phẩm
                    </a>
                    </div>
                    
                  <div class="form-group">
                    <a href="{{route('product.trash')}}" class="btn btn-info"><i class="fa fa-trash "></i>Thùng rác</a>
                  </div>
                  </div>
                  
                </div>
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
                        <th>Giá sản phẩm</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Action</th>
                        
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Ảnh</th>
                        <th>Tên danh mục</th>
                        <th>Danh mục</th>
                        <th>Giảm giá %</th>
                        <th>Giá sản phẩm</th>
                        <th>Tag</th>
                        <th>Slug</th>
                        <th>Ngày tạo</th>
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
                        <td>{{ $product->category ? $product->category->name : 'Không có danh mục' }}</td>
                        <td>{{$product->discount}}%</td>
                        <td>{{number_format($product->price)}} đ</td>
                        <td>{{$product->tag}}</td>
                        <td>{{$product->slug}}</td>
                        <td>{{$product->created_at}}</td>
                        <td class="d-flex gap-1 justify-content-around ">
                            <a href="{{route('product.edit',$product)}}" class="btn btn-primary p-2"> 
                                <i class="fas fa-wrench"></i>
                                Sửa
                            </a>
                            <form action="{{route('product.destroy',$product)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger p-2" onclick="return confirm('Bạn có chắc chắn là xoá ?');">
                                <i class="fas fa-trash-alt"></i>
                                 Xoá
                           </button>
                            </form>
                            
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
    </div>
</div>

@endsection
