@extends('admin.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="card card-round">
            <div class="card-header">
              <div class="card-head-row">
                <div class="card-title">Order</div>
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
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Total Items</th>
                        <th>Delivered On</th>
                        <th class="text-center">Action</th>

                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Subtotal</th>
                          <th>Total</th>
                          <th>Status</th>
                          <th>Order Date</th>
                          <th>Total Items</th>
                          <th>Delivered On</th>
                          <th class="text-center">Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      @foreach ($orders as $order)
                      <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{ $order->subtotal}}$</td>
                        <td>{{$order->total}}$</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->orderItems->count()}}</td>
                        <td>{{$order->delivered_date}}</td>

                        <td class="d-flex gap-1 justify-content-around ">
                            <a href="{{route('order.show',$order->id)}}" class="btn btn-primary p-2">
                                <i class="fas fa-eye"></i>
                                show
                            </a>


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
