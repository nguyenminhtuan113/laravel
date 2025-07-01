@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Cập nhật sản phẩm</div>
                <div class="card-tools">
                </div>
              </div>
            </div>

            <div class="card-body">
                <div class="col-md-12">
                  <form action="{{route('product.update',$product)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$product->id}}" >

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group @error('name') has-error @enderror">
                          <label for="productName">Tên sản phẩm</label>
                          <input type="text" class="form-control" name="name" value="{{old('name') ? old('name') : $product->name}}" id="productName" placeholder="Nhập tên sản phẩm" onkeyup="ChangeToSlug();">
                          
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('discount') has-error @enderror">
                          <label for="discount">Discount % </label>
                          <input type="number" value="{{old('discount') ? old('discount') : $product->discount}}" class="form-control" name="discount" id="discount" placeholder="Nhập giá khuyến mại vd: 10%">
                          
                            @error('discount')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="category">Chọn danh mục:</label>
                          <select name="category_id" id="category" class="form-control">
                              <option value="0">-- Danh sách danh mục --</option>
                              @foreach ($categories as $category)
                                  <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                  @if ($category->children->count() > 0)
                                      @include('admin.pages.product.option', ['children' => $category->children, 'level' => 1])
                                  @endif
                              @endforeach
                          </select>
                      </div>

                      <div class="form-group">
                        <label for="editor1">Mô tả sản phẩm</label>
                        <textarea name="description"  id="editor1" rows="10" cols="80">
                          {{ old('description', $product->description) }}
                        </textarea>
                      </div>

                      </div>

                      <div class="col-md-6">
                        <div class="form-group @error('slug') has-error @enderror">
                          <label for="slug">Đường dẫn slug</label>
                          <input type="text" class="form-control" name="slug" value="{{old('slug',$product->slug)}}" id="slug" placeholder="Nhập đường dẫn slug" >
                          
                            @error('slug')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group @error('price') has-error @enderror">
                          <label for="price">Giá sản phẩm</label>
                          <input type="number" class="form-control" value="{{old('price') ? old('price') : $product->price}}" name="price" id="price" placeholder="Nhập giá sản phẩm">
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('tag') has-error @enderror">
                          <label for="tag">Tag</label>
                          <input type="text" class="form-control" name="tag" value="{{old('tag') ? old('tag') : $product->tag}}" id="tag" placeholder="Nhập tag">
                            @error('tag')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="img">Ảnh</label>
                            <input type="file" name="photo"  id="img" class="form-control"/>
                        </div>
                        @if ($product->img)
                          <div class="form-group">
                            <p>Hình ảnh hiện tại</p>
                            <img src="{{asset('storage/images')}}/{{$product->img}}" style="max-width: 200px;" alt="{{$product->name}}">
                            <label>
                              Xoá
                              <input type="checkbox" name="delete_photo" value="{{$product->id}}">
                            </label>

                          </div>
                            
                        @endif

                        <div class="form-group">
                          <label for="photos">Ảnh mô tả</label>
                          <input type="file" name="photos[]" id="photos" class="form-control" multiple/>
                          <p>Hình ảnh mô tả</p>
                            <div class="d-flex justify-center gap-2 flex-wrap ">
                          @foreach($product->imgProduct as $image)
                              <div class="d-flex flex-column">
                                <img src="{{ asset('storage/images/' . $image->img) }}" alt="{{$product->name}}" style="max-width: 200px;">
                                <label>
                                  Xoá 
                                  <input type="checkbox" name="delete_photos[]" value="{{$image->id}}">
                                </label>
                              </div>
                                
                          @endforeach

                            </div>
                                
                        </div>
                        </div>
                      </div>
                    </div>
                      <div class="form-group">
                        <a href="{{route('product.index')}}" class="btn btn-dark">Trở lại</a>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                      </div>
                  </form>
                  
                </div>
                
            </div>
                
          </div>
    </div>
</div>

@endsection
@section('custom-js')
<script src="{{asset('assets/tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
  <script type="text/javascript">
  tinymce.init({
    selector: 'textarea',
    license_key: 'gpl'
  });
  </script>
  <script language="javascript">
    function ChangeToSlug()
    {
        var productName, slug;

        //Lấy text từ thẻ input title 
        productName = document.getElementById("productName").value;

        //Đổi chữ hoa thành chữ thường
        slug = productName.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }
</script>
@endsection