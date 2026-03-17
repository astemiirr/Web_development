<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Просмотр каталога (для всех)
    public function index(Request $request)
    {
        $query = Product::with('category');
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->paginate(9);
        
        return view('products.index', compact('products'));
    }

    // Просмотр одного товара (для всех)
    public function show(Product $product)
    {
        // Сохраняем в сессию для "недавно просмотренных"
        $recent = session()->get('recent_products', []);
        if (!in_array($product->id, $recent)) {
            array_unshift($recent, $product->id);
            session()->put('recent_products', array_slice($recent, 0, 5)); // храним 5 последних
        }

        return view('products.show', compact('product'));
    }
}