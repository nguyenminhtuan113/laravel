@extends('admin.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Order details</div>
                        <div class="card-tools">
                            <a href="{{route('order.index')}}" class="btn btn-dark">Back</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-sub">
                        <div class="card-title">Order</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Order No</th>
                                <td>{{$order->id}}</td>
                                <th>Mobile</th>
                                <td>{{$order->phone}}</td>
                                <th>Zip Code</th>
                                <td>{{$order->zip}}</td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{$order->created_at}}</td>
                                <th>Delivered Date</th>
                                <td>{{$order->delivered_date}}</td>
                                <th>Canceled Date</th>
                                <td>{{$order->canceled_date}}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td colspan="5">
                                    @if($order->status == 'delivered')
                                        <span class="bg bg-success">Delivered</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="bg bg-danger">Canceled</span>
                                    @else
                                        <span class="bg bg-warning">Ordered</span>

                                    @endif
                                </td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
{{--            order item--}}
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Order Item</div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="card-sub">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Return Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderItems as $item)
                                <tr>
                                    <td>
                                        <img src="{{$item->product->img}}" width="50px">
                                        {{$item->product->name}}
                                    </td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->product->category->name}}</td>
                                    <td>{{$item->rstatus == 0 ? 'No' : 'Yes'}}</td>
                                    <td>
{{--                                        <a href="" class="btn btn-primary"><i class="fa fa-eye"></i>show</a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

{{--            shipp--}}
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Shipping Address</div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="card-sub">

                    </div>
                    <div class="table-responsive">
                        <p>Name: {{$order->name}}</p>
                        <p>Phone number: {{$order->phone}}</p>
                        <p>Address: {{$order->address}}</p>
                        <p>Locality: {{$order->locality}}</p>
                        <p>City , Country: {{$order->city}}, {{$order->country}}</p>
                        <p>Landmark: {{$order->landmark}}</p>
                        <p>Zip code: {{$order->zip}}</p>
                    </div>
                </div>
            </div>
            {{--            transaction--}}
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Transaction</div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="card-sub">

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>${{$order->subtotal}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>${{$order->total}}</td>
                                <th>Payment mode</th>
                                <td>{{$order->transaction->mode}}</td>
                                <th>Status</th>
                                <td>
                                    @if($transaction->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($transaction->status == 'declined')
                                        <span class="badge bg-danger">Declined</span>
                                    @elseif($transaction->status == 'refunded')
                                        <span class="badge bg-secondary">Refunded</span>
                                    @else
                                        <span class="badge bg-warning">pending</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

{{--            update status--}}
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Update Order Status</div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="card-sub">

                    </div>
                    <form action="{{route('order.update.status')}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <select id="order_status" class="form-control" name="order_status">
                                    <option  value="ordered" {{$order->status == 'ordered' ? 'selected' : ''}}>Ordered</option>
                                    <option value="delivered" {{$order->status == 'delivered' ? 'selected' : ''}}>Delivered</option>
                                    <option value="canceled" {{$order->status == 'canceled' ? 'selected' : ''}}>Canceled</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Update status</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
