@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Cập nhật danh mục</div>
                <div class="card-tools">
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="col-md-6 col-lg-4">
                    <form action="{{route('category.update',$category)}}" method="post">
                      @method('PUT')
                      @csrf
                      <input type="hidden" name="id" value="{{$category->id}}" >
                        <div class="form-group @error('name') has-error @enderror">
                            <label for="name">Tên danh mục</label>
                            <input type="text"  class="form-control" name="name" value="{{old('name') ? old('name') : $category->name }}" id="name" placeholder="Nhập tên danh mục">
                            
                              @error('name')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                          </div>
                          {{-- <div class="form-group">
                            <label for="defaultSelect">Danh mục cha</label>
                            <select name="parent_id" class="form-select form-control" id="defaultSelect">
                              <option value="0">Chọn danh mục cha</option>
                              @foreach ($categories as $item)
                              <option value="{{$item->id}}" {{$category->parent_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                              @endforeach
                              
                              
                            </select>
                          </div> --}}
                          <div class="form-group">
                            <label for="parent_id">Danh mục cha:</label>
                            <select name="parent_id" class="form-control">
                                <option value="0">-- Không có danh mục cha --</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" 
                                        {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                    @if ($parentCategory->children->count() > 0)
                                        @include('admin.pages.category.optionEdit', ['children' => $parentCategory->children, 'level' => 1, 'selected' => $category->parent_id])
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
                                  {{$category->status ? 'checked' : ''}}
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
                                  {{!$category->status ? 'checked' : ''}}
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
                            <a href="{{route('category.index')}}" class="btn btn-black">Trở lại</a>
                            <button type="submit" class="btn btn-success">Cập nhật</button>
                        </div>
                    </form>
                    
                    
                  </div>
              </div>
    </div>
</div>

@endsection
