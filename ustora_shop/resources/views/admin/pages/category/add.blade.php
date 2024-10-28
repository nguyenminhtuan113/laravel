@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Thêm danh mục</div>
                <div class="card-tools">
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="col-md-6 col-lg-4">
                    <form action="{{route('category.store')}}" method="post">
                      @csrf
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Tên danh mục</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
                            
                              @error('name')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>

                          {{-- <div class="form-group">
                            <label for="defaultSelect">Danh mục cha</label>
                            <select name="parent_id" class="form-select form-control" id="defaultSelect">
                              <option value="0">Chọn danh mục cha</option>
                              @foreach ($categories as $item)
                              <option value="{{ $item->id }}">{{$item->name}}</option>
                              @endforeach
                            </select>
                          </div> --}}

                          <div class="form-group">
                            <label for="category">Chọn danh mục:</label>
                            <select name="parent_id" id="category" class="form-control">
                                <option value="">-- Danh sách danh mục --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @if ($category->children->count() > 0)
                                        @include('admin.pages.category.option', ['children' => $category->children, 'level' => 1])
                                    @endif
                                @endforeach
                            </select>
                        </div>

                          <div class="form-group">
                            <label>Chọn trạng thái</label><br />
                            <div class="d-flex">
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="status"
                                  id="flexRadioDefault1"
                                  checked
                                  value="1"

                                />
                                <label
                                  class="form-check-label"
                                  for="flexRadioDefault1"

                                >
                                  Hiển thị
                                </label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="status"
                                  id="flexRadioDefault2"
                                  value="0"
                                />
                                <label
                                  class="form-check-label"
                                  for="flexRadioDefault2"
                                >
                                  Ẩn
                                </label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Thêm</button>
                        </div>
                    </form>
                    
                    
                  </div>
              </div>
    </div>
</div>

@endsection
