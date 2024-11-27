<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng của người dùng.
     */
    public function index()
    {
        $cart = Auth::user()->carts()->latest()->first();

        if (!$cart) {
            return view('user.pages.cart', [
                'cartDetail' => [],
                'total' => 0,
            ])->with('error', 'Giỏ hàng của bạn trống.');
        }

        $cartDetail = CartDetail::with(['productVariant.product', 'productVariant.chip', 'productVariant.ram', 'productVariant.storage'])
            ->where('carts_id', $cart->id)
            ->get();

        $total = $cartDetail->sum(function ($detail) {
            $price = $detail->productVariant->sale_price ?? $detail->productVariant->listed_price;
            return $price * $detail->quantity;
        });

        return view('user.pages.cart', compact('cartDetail', 'total'));
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng.');
        }
    
        $variant_id = $request->variant_id;
        $quantity = $request->quantity;
    
        // Lấy biến thể sản phẩm
        $productVariant = ProductVariant::find($variant_id);
    
        if (!$productVariant) {
            return redirect()->back()->with('error', 'Không có sản phẩm cần mua.');
        }
    
        // Kiểm tra số lượng sản phẩm trong kho của biến thể
        if ($productVariant->quantity <= 0) {
            return redirect()->back()->withErrors(['quantity' => 'Sản phẩm hiện tại không còn trong kho.']);
        }
    
        // Kiểm tra nếu số lượng yêu cầu lớn hơn số lượng tồn kho
        if ($productVariant->quantity < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Số lượng sản phẩm không đủ trong kho.']);
        }
    
        // Tạo hoặc cập nhật giỏ hàng
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartDetail = CartDetail::firstOrNew([
            'carts_id' => $cart->id,
            'product_variant_id' => $variant_id,
        ]);
    
        $cartDetail->quantity = $cartDetail->exists ? $cartDetail->quantity + $quantity : $quantity;
        $cartDetail->save();
    
        return redirect()->route('cart.index')->with('success', 'Thêm vào giỏ hàng thành công!');
    }
    
    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng.
     */
    public function update(Request $request, $id)
    {
        $cartDetail = CartDetail::findOrFail($id);
    
        // Lấy thông tin biến thể sản phẩm
        $productVariant = ProductVariant::find($cartDetail->product_variant_id);
    
        if (!$productVariant) {
            return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại.');
        }
    
        $quantity = $request->quantity;
    
        // Kiểm tra số lượng trong kho
        if ($productVariant->quantity <= 0) {
            return redirect()->back()->withErrors(['quantity' => 'Sản phẩm hiện tại không còn trong kho.']);
        }
    
        // Kiểm tra nếu số lượng yêu cầu lớn hơn số lượng tồn kho
        if ($productVariant->quantity < $quantity) {
            return redirect()->back()->withErrors(['quantity' => 'Số lượng sản phẩm không đủ trong kho.']);
        }
    
        // Cập nhật số lượng giỏ hàng
        $cartDetail->quantity = $quantity;
        $cartDetail->save();
    
        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng.
     */
    public function destroy($id)
    {
        $cartDetail = CartDetail::findOrFail($id);
        $cartDetail->delete();
        return redirect()->back()->with('success', 'Xóa sản phẩm khỏi giỏ hàng thành công.');
    }
}

