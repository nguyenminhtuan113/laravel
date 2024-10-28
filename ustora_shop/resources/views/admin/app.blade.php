<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{asset('assets/img/kaiadmin/favicon.ico')}}"
      type="image/x-icon"
    />
    <!-- CSS Files -->
    @include('admin.sites.style')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('admin.sites.sidebar')
      <!-- End Sidebar -->
      <div class="main-panel">

        @include('admin.sites.header')

        @yield('content')

        @include('admin.sites.footer')

      </div>
       
      </div>
    </div>
    <!--   Core JS Files   -->
    @include('admin.sites.script')
    @yield('custom-js')
  </body>
</html>
