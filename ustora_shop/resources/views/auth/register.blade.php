<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng kí</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('auth/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('auth/assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <h3 class="text-center">Đăng kí</h3>
                <form action="" method="POST">
                    @csrf
                  <div class="mb-3 @error('name') has-error @enderror ">
                    <label for="name" class="form-label">Tên người dùng</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" >
                      @error('name')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-3 @error('email') has-error @enderror">
                    <label for="email" class="form-label">Email </label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email">
                      @error('email')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-4 @error('password') has-error @enderror">
                    <label for="ipPassword" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="ipPassword">
                      @error('password')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-4 @error('password_confirmation') has-error @enderror">
                    <label for="comfirmPassword" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" id="comfirmPassword">
                      @error('password_confirmation')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>


                  <button type="submit" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Đăng kí</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Bạn đã có tài khoản?</p>
                    <a class="text-primary fw-bold ms-2" href="{{route('login')}}">Đăng nhập</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('auth/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('auth/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
