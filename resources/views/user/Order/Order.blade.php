@extends('user.layout')
@section('css')
    <style>
        .product-number,
        .product-name,
        .product-bank,
        .product-quantity,
        .product-number,
        .product-date,
        .product-delivery,
        .product-cancel,
        .product-subtotal {
            text-align: center;
            text-transform: uppercase;

        }

        .product-number p {
            text-align: center;
            border: 1px solid black;
            border-radius: 14px;
        }



        .content-area {
            color: black;
            font-size: 18px;
            text-transform: uppercase;
            z-index: 1;
            border: 5px solid black;
            background-color: #f3f3f3;
            border-radius: 9px;
        }


        .border-gadrient::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 10px;
            border: 5px solid transparent;
            box-sizing: border-box;
            transition: border 0.4s ease-in-out;
        }

        .border-gadrient:hover {
            border-color: transparent;
            /* Ẩn viền đen khi hover */
        }

        .border-gadrient:hover::before {
            border: 5px solid transparent;
            /* Ẩn viền trong khi hover */
            animation: borderMove 3s linear infinite;
            /* Điều chỉnh thời gian ở đây */
        }

        .btn-cancel {
            background-color: #f44336;
            /* Màu đỏ */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-cancel:hover {
            background-color: #d32f2f;
            /* Đổi màu khi hover */
        }
    </style>
@endsection
@section('content')

    <body class="page home page-template-default">
        <div id="page" class="hfeed site">

            @include('user.partials.header')

            @include('user.partials.menu')

            <!-- .header-v2 -->
            <!-- ============================================================= Header End ============================================================= -->
            <div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <nav class="woocommerce-breadcrumb">
                            <a href="home-v1.html">Home</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            Cart
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="cart-wrapper2">

                                                <table class="shop_table shop_table_responsive cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-remove">&nbsp;</th>
                                                            <th class="product-thumbnail">&nbsp;</th>
                                                            <th><input type="checkbox" id="selectAll">ALL</th>
                                                            <th class="product-number"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Mã Đơn Hàng</th>
                                                            <th class="product-date"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Ngày Đặt</th>
                                                            <th class="product-name"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Khách Hàng</th>
                                                            <th class="product-bank"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Trạng Thái Đơn Hàng</th>
                                                            <th class="product-delivery"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Trạng Thái Thanh Toán</th>
                                                            <th class="product-subtotal"
                                                                style="text-transform: uppercase; color: black; font-size: 18px">
                                                                Tổng Tiền</th>

                                                            <th class="product-cancel"
                                                                style="text-transform: uppercase; color: black; font-size: 18px"">
                                                                Thao Tác
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($donhang as $items)
                                                            <tr>

                                                                <td class="product-thumbnail">
                                                                    <a href="single-product-fullwidth.html">
                                                                        <img width="180" height="180" alt=""
                                                                            class="wp-post-image"
                                                                            src="single-product-fullwidth.html">
                                                                    </a>
                                                                </td>
                                                                <td><input type="checkbox" class="select"></td>
                                                                <td data-title="number" class="product-number">
                                                                    <p>{{ $items->order_id }}</p>
                                                                </td>
                                                                <td data-title="date" class="product-date"
                                                                    style="text-align: center">
                                                                    <p>{{ $items->datetime }}</p>
                                                                </td>

                                                                <td data-title="name" class="product-name">
                                                                    <p>{{ $items->users['name'] }}</p>
                                                                </td>

                                                                <td data-title="bank" class="product-bank">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span
                                                                            class="woocommerce-Price-currencySymbol">{{ $TrangThaiDonHang[$items->to_status] }}
                                                                        </span>
                                                                </td>   

                                                                <td data-title="delivery" class="product-delivery">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span
                                                                            class="woocommerce-Price-currencySymbol">{{ $TrangThaiThanhToan[$items->from_status] }}
                                                                        </span>
                                                                </td>
                                                                <td data-title="Total" class="product-subtotal">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span
                                                                            class="woocommerce-Price-currencySymbol">{{ $items->order->money_total }}</span>đ
                                                                    </span>
                                                                    {{-- <a title="Remove this item" class="remove"
            href="#">×</a> --}}
                                                                </td>

                                                                <td data-title="cancel" class="product-cancel">
                                                                    <a href="{{ route('order.detail', $items->order->id) }}">
                                                                        view
                                                                    </a>
                                                                    <form action="{{ route('cart.editOrder', $items->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        @if ($items->to_status === $typeChoXacNha)
                                                                            <input type="hidden" name="to_status"
                                                                                value="huy_hang">
                                                                            <button type="submit">Hủy hàng</button>
                
                                                                        @elseif($items->to_status === $typeDaXacNhan)
                                                                            <input type="hidden" name="to_status"
                                                                                value="da_nhan_hang">
                                                                            <button type="submit">Đã nhận hàng</button>
                                                                        
                                                                        @elseif($items->to_status === $typeDangChuanBi)
                                                                        <input type="hidden" name="to_status"
                                                                            value="da_nhan_hang">
                                                                        <button type="submit">Đã nhận hàng</button>
                                                                   
                                                                    @elseif($items->to_status === $typeDangVanChuyen)
                                                                    <input type="hidden" name="to_status"
                                                                        value="da_nhan_hang">
                                                                    <button type="submit">Đã nhận hàng</button>
                                                                @endif
                                                                    </form>
                                                                </td>



                                                                {{-- <td style="text-align: center">

        <a href=""
            class="btn btn-warning d-inline-block me-1"><i
                class="ri-pencil-fill fs-16"></i></a>
        <form action="" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit"
                onclick="return confirm('Bạn có chắc muốn xóa không?')"><i
                    class="ri-delete-bin-5-fill fs-16"></i></button>
        </form>

    </td> --}}
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                                <!-- .shop_table shop_table_responsive -->

                                                <!-- .woocommerce-cart-form -->

                                                <!-- .cart-collaterals -->
                                            </div>
                                            <!-- .cart-wrapper -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .entry-content -->
                                </div>
                                <!-- .hentry -->
                            </main>
                            <!-- #main -->
                        </div>

                    </div>
                    <!-- #primary -->
                </div>
                <!-- .row -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- #content -->

        @include('user.partials.footer')

        <!-- .site-footer -->
        <script>
            document.getElementById('selectAll').addEventListener('change', function() {
                let checkboxes = document.querySelectorAll('.select');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        </script>
        </div>

        @include('user.partials.js')

    </body>
@endsection