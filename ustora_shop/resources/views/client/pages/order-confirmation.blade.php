<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Nhận Đơn Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Navbar */
        .navbar {
            width: 100%;
            background-color: #343a40;
            padding: 10px;
            text-align: center;
            color: #fff;
        }

        /* Container */
        .confirm-order-container {
            width: 90%;
            max-width: 800px;
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        /* Order and customer details */
        .section {
            margin-bottom: 20px;
            text-align: left;
        }

        .section h4 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
        }

        .section p, .section-item {
            margin: 8px 0;
        }

        /* Product list */
        .product-list {
            margin-bottom: 20px;
        }

        .product-item {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }

        .product-item img {
            width: 80px;
            height: 80px;
            margin-right: 10px;
            border-radius: 4px;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
        }

        .product-details h5 {
            margin: 0;
            font-size: 16px;
        }

        .product-details p {
            margin: 4px 0;
            font-size: 14px;
            color: #555;
        }

        /* Summary */
        .summary {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }

        /* Buttons */
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            flex: 1;
            margin: 0 5px;
        }

        .btn-confirm {
            background-color: #28a745;
        }

        .btn-cancel {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h3>Cửa Hàng Ustora - Xác Nhận Đơn Hàng</h3>
</div>

<div class="confirm-order-container">
    <h2>Xác Nhận Đơn Hàng</h2>

    <div class="section">
        <h4>Thông Tin Đơn Hàng</h4>
        <p><strong>Mã đơn hàng:</strong> #{{$order->id}}</p>
        <p><strong>Ngày đặt hàng:</strong> {{$order->created_at}}</p>
        <p><strong>Phương thức thanh toán:</strong> Thanh toán khi nhận hàng (COD)</p>
    </div>

    <div class="section">
        <h4>Thông Tin Sản Phẩm</h4>
        <div class="product-list">
            <!-- Product Item 1 -->
            @foreach($order->orderItems as $item)
            <div class="product-item">
{{--                <img src="https://via.placeholder.com/80" alt="Product Image">--}}
                <div class="product-details">
                    <h5>{{$item->product->name}}</h5>
                    <p>Số lượng: {{$item->quantity}}</p>
                    <p>Giá: {{$item->price}}$</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="section">
        <h4>Thông Tin Người Nhận</h4>
        <p><strong>Tên:</strong> {{$order->user->name}}</p>
        <p><strong>Số điện thoại:</strong> {{$order->phone}}</p>
        <p><strong>Địa chỉ:</strong> {{$order->address}}</p>
        <p><strong>Ghi chú:</strong> Giao vào buổi sáng</p>
    </div>

    <div class="section">
        @foreach($order->orderItems as $item)
        <h4>Chi Tiết Thanh Toán</h4>
        <p><strong>Tổng tiền sản phẩm:</strong> {{$item->price}}$ </p>
        <p><strong>Phí vận chuyển:</strong> Free ship</p>
        <p class="summary"><strong>Tổng cộng:</strong> {{$item->price}}$</p>
        @endforeach
            <a href="{{route('home')}}">Trở về</a>
    </div>

</div>

</body>
</html>
