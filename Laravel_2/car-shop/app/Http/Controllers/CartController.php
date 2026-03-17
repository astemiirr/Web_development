<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Просмотр корзины
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;
        
        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();
            
            foreach ($products as $product) {
                $total += $product->price * $cart[$product->id];
            }
        }
        
        return view('cart.index', compact('cart', 'products', 'total'));
    }

    // Добавление в корзину
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]++;
        } else {
            $cart[$product->id] = 1;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    // Оформление заказа
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_date' => now()
            ]);

            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cart[$product->id],
                    'price' => $product->price
                ]);
            }

            DB::commit();
            session()->forget('cart'); // Очищаем корзину
            
            return redirect()->route('profile.orders')->with('success', 'Заказ успешно оформлен! Номер заказа: ' . $order->id);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ошибка при оформлении заказа');
        }
    }
}