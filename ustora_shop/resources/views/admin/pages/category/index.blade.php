@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Quản lí danh mục</div>
                <div class="card-tools">
                  <div class="d-flex">
                    <div class="form-group">
                      <a href="{{route('category.create')}}" class="btn btn-dark ">
                        <i class="fas fa-plus"></i>
                        Thêm danh mục
                    </a>
                    </div>
                    
                  <div class="form-group">
                    <a href="{{route('category.trash')}}" class="btn btn-info"><i class="fa fa-trash "></i>Thùng rác</a>
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
                        <th>Tên danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
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
                        <th class="text-center">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->parent ? $category->parent->name : 'No Parent' }}</td>
                        <td>{!!$category->status ? 
                                                    '<small class="text-white bg-success p-2 ">Hiển thị</small>'
                                                  : '<small class="text-white bg-danger p-2">Ẩn</small>'!!}
                        </td>
                        <td>{{$category->created_at}}</td>
                        <td class="d-flex gap-1 justify-content-center">
                            <a href="{{route('category.edit',$category)}}" class="btn btn-primary p-2"> 
                                <i class="fas fa-wrench"></i>
                                Sửa
                            </a>
                            <form action="{{route('category.destroy',$category)}}" method="POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger p-2" onclick="return confirm('Bạn có chắc chắn là xoá ?')">
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
