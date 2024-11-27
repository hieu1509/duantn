<?php

namespace App\Http\Controllers\view;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    //
    public function index()
    {
        $listDonHang = OrderHistory::query()->with('order')->orderByDesc('id')->get();
        // dd($listDonHang);
        $trangThaiDonHang = Order::TRANG_THAI_DON_HANG;
        foreach ($trangThaiDonHang as $key => $value) {
            $key_trang_thai = $key;
            $value_trang_thai = $value;
        }

        return view('admin.order.index', compact('listDonHang', 'trangThaiDonHang', 'key_trang_thai', 'value_trang_thai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = Order::query()->findOrFail($id); 
        $user_id  = $donHang->user_id;
        $trangThaiDonHang = Order::TRANG_THAI_DON_HANG;
        $trangThaiThanhToan = Order::TRANG_THAI_THANH_TOAN;
        $productDetails_id = $donHang->orderDetails->pluck('productvariant_id')->toArray();// khóa 
        $productDetails = ProductVariant::whereIn('id', $productDetails_id)->get();
        // $orderDetails = $donHang->order->OrderDetail;
        // dd($donHang);

    
        return view('admin.order.show', compact('donHang', 'trangThaiDonHang', 'trangThaiThanhToan', 'productDetails',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = OrderHistory::query()->findOrFail($id);
        $currentTrangThai = $donHang->to_status;
        // dd($currentTrangThai);
        $newTrangThai = $request->input('order_status');
        $trangThais = array_keys(Order::TRANG_THAI_DON_HANG);
        // kiếm tra nếu đơn hàng đã bị hủy thì không được thay đổi trạng thái nữa
        if ($currentTrangThai == Order::HUY_HANG) {
            return redirect()->route('admins.orders.index')->with('error', 'đơn hàng đã bị hủy không thể thay đổi được trạng thái đơn hàng');
        }
        // kiểm tra nếu  trạng thái mới không được nằm sau trạng thái hiện tại
        if (array_search($newTrangThai, $trangThais) < array_search($currentTrangThai, $trangThais)) {
            return redirect()->route('admins.orders.index')->with('error', 'không thể cập nhật ngược lại trạng thái');
        }
        $donHang->to_status = $newTrangThai;
        $donHang->save();
        return redirect()->route('admins.orders.index')->with('success', 'cập nhật trạng thái thành công'.' '. $donHang->order->code);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


   
}
