@extends('client.index')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Order</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Order</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Order No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Items</th>
                            <th scope="col">Delivered On</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->phone}}</td>
                                <td>{{$order->subtotal}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    @if($order->status == 'delivered')
                                        <span class="badge bg-success" style="background: green">Delivered</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="badge bg-danger" style="background: red">Canceled</span>
                                    @else
                                        <span class="badge bg-warning" style="background: yellow;color: black">Ordered</span>
                                    @endif
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->orderItems->count()}}</td>
                                <td>{{$order->delivered_date}}</td>
                                <td>
                                    <a href="{{route('show.order',$order->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i> Show</a>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="product-pagination text-center">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
