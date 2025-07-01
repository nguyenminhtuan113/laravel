<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{route('admin')}}" class="logo">
          <img
            src="{{asset('assets/img/kaiadmin/logo_light.svg')}}"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{ Request::routeIs('admin') ? 'active' : '' }}">
            <a
              href="{{route('admin')}}"
              class="btn"
            >
              <i class="fas fa-home"></i>
              <p>Trang chủ</p>
            </a>
          </li>


          {{-- <li class="nav-item {{ Request::routeIs('admin') ? 'active' : '' }}">
            <a
              href="{{route('admin')}}"
              class="btn"
            >
            <i class="fas fa-people-roof"></i>
              <p>Administrator</p>
            </a>

          </li> --}}

          <li class="nav-item {{Request::is('admin/category*') ? 'active' : ''}}">
            <a
              data-bs-toggle="collapse"
              href="#category"
              class="collapsed"
              aria-expanded="{{ Request::is('admin/category*') ? 'true' : 'false' }}"
            >
            <i class="fas fa-th-list"></i>
              <p>Quản lí danh mục</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('admin/category*') ? 'show' : '' }}"  id="category">
              <ul class="nav nav-collapse">
                <li class="{{ Request::routeIs('category.index') ? 'active' : '' }}">
                  <a href="{{route('category.index')}}">
                    <span class="sub-item">Danh sách danh mục</span>
                  </a>
                </li>
                <li class="{{ Request::routeIs('category.create') ? 'active' : '' }}">
                  <a href="{{route('category.create')}}">
                    <span class="sub-item">Thêm danh mục</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item {{Request::is('admin/product*') ? 'active' : ''}}">
            <a
              data-bs-toggle="collapse"
              href="#product"
              class="collapsed"
              aria-expanded="{{ Request::is('admin/product*') ? 'true' : 'false' }}"
            >
            <i class="fas fa-th-list"></i>
              <p>Quản lí sản phẩm</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('admin/product*') ? 'show' : '' }}" id="product">
              <ul class="nav nav-collapse">
                <li class="{{ Request::routeIs('product.index') ? 'active' : '' }}">
                  <a href="{{route('product.index')}}">
                    <span class="sub-item">Danh sách sản phẩm</span>
                  </a>
                </li>
                <li class="{{ Request::routeIs('product.create') ? 'active' : '' }}">
                  <a href="{{route('product.create')}}">
                    <span class="sub-item">Thêm sản phẩm</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item {{Request::is('admin/order*') ? 'active' : ''}}">
            <a
              data-bs-toggle="collapse"
              href="#order"
              class="collapsed"
              aria-expanded="{{ Request::is('admin/order*') ? 'true' : 'false' }}"
            >
            <i class="fas fa-th-list"></i>
              <p>Quản lí Order</p>
              <span class="caret"></span>
            </a>
            <div class="collapse {{ Request::is('admin/order*') ? 'show' : '' }}" id="order">
              <ul class="nav nav-collapse">
                <li class="{{ Request::routeIs('order.index') ? 'active' : '' }}">
                  <a href="{{route('order.index')}}">
                    <span class="sub-item">Danh sách Order</span>
                  </a>
                </li>
                
              </ul>
            </div>
          </li>


        </ul>
      </div>
    </div>
  </div>
