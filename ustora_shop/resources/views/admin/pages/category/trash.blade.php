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
                        <th>Tên danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày xoá</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày xoá</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent_id}}</td>
                        <td>{!!$category->status ? 
                                                    '<small class="text-white bg-success p-2 ">Hiển thị</small>'
                                                  : '<small class="text-white bg-danger p-2">Ẩn</small>'!!}
                        </td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->deleted_at}}</td>
                        <td class="d-flex gap-1 justify-content-around">
                            <a href="{{route('category.restore',$category->id)}}" class="btn btn-primary p-2"> 
                                <i class="fas fa-redo"></i>
                                Khôi phục
                            </a>
                            <a href="{{route('category.forceDelete',$category->id)}}" class="btn btn-danger p-2" onclick="return comfirm('Bạn có chắc chắn xoá vĩnh viễn ?')"> 
                                <i class="fas fa-trash-alt"></i>
                                Xoá vĩnh viễn
                            </a>
                        </td>
                      </tr>
                   
                      @endforeach
                     
                    </tbody>
                  </table>
                  <div class="form-group">
                    <a href="{{route('category.index')}}" class="btn btn-black">Trở lại</a>
                  </div>
                </div>
              </div>
    </div>
</div>

@endsection
