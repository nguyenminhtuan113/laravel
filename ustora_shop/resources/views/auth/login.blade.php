
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng nhập người dùng</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('auth/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('auth')}}/assets/css/styles.min.css" />
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

                <h3 class="text-center">Đăng nhập</h3>
                <form action="{{route('login.post')}}" method="POST">
                    @csrf
                  <div class="mb-3 @error('email') has-error @enderror">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                      @error('email')
                        <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="mb-4 @error('password') has-error @enderror">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" value="{{old('password')}}" class="form-control" id="exampleInputPassword1">
                      @error('password')
                      <div class="text-danger">{{$message}}</div>
                      @enderror
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
{{--                    <div class="form-check">--}}
{{--                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>--}}
{{--                      <label class="form-check-label text-dark" for="flexCheckChecked">--}}
{{--                        Ghi nhớ thiết bị này--}}
{{--                      </label>--}}
{{--                    </div>--}}
{{--                    <a class="text-primary fw-bold" href="">Quên mật khẩu ?</a>--}}
                  </div>
                  <button type="submit" class="btn btn-primary w-100 fs-4 mb-4 rounded-2">Đăng nhập</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Ustora?</p>
                    <a class="text-primary fw-bold ms-2" href="{{route('register')}}">Tạo tài khoản mới</a>

                  </div>
                    <div class="col-md-12 mt-3">
                        <a href="{{route('google.redirect')}}">
                            <img width="150"
                                 src="data:image/png;base64,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" alt="">
                        </a>
                        <a href="{{route('facebook.redirect')}}" class="bg-primary text-white p-2 fs-1">
                            <img src="data:image/png;base64,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" alt=""
                                 width="30">
                            Login with facebook
                        </a>

                    </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('auth')}}/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="{{asset('auth')}}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
