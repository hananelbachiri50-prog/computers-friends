<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display products with optional search
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $favorites = session('favorites', []);
        
        return view('welcome', compact('products', 'favorites'));
    }

    /**
     * Display product details
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $favorites = session('favorites', []);
        return view('product-details', compact('product', 'favorites'));
    }

    /**
     * Toggle product favorite status
     */
    public function toggleFavorite($productId)
    {
        $favorites = session('favorites', []);
        
        if (in_array($productId, $favorites)) {
            // Remove from favorites
            $favorites = array_diff($favorites, [$productId]);
            $inFavorites = false;
        } else {
            // Add to favorites
            $favorites[] = $productId;
            $inFavorites = true;
        }
        
        $favorites = array_values($favorites);
        session(['favorites' => $favorites]);
        
        return response()->json([
            'success' => true,
            'inFavorites' => $inFavorites,
            'favoritesCount' => count($favorites)
        ]);
    }

    /**
     * Display favorites page
     */
    public function favorites()
    {
        $favorites = session('favorites', []);
        $products = Product::whereIn('id', $favorites)->get();
        
        return view('favorites', compact('products', 'favorites'));
    }

    /**
     * Add product to cart
     */
    public function addToCart($productId)
    {
        $cart = session('cart', []);
        
        if (in_array($productId, $cart)) {
            $message = 'Produit déjà dans le panier';
            $action = 'exists';
        } else {
            $cart[] = $productId;
            $message = 'Produit ajouté au panier avec succès';
            $action = 'added';
        }
        
        session(['cart' => $cart]);
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'action' => $action,
            'cartCount' => count($cart)
        ]);
    }

    /**
     * Display cart page
     */
    public function cart()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', $cart)->get();
        $total = $products->sum('price');
        
        return view('cart', compact('products', 'cart', 'total'));
    }

    /**
     * Remove product from cart
     */
    public function removeFromCart($productId)
    {
        $cart = session('cart', []);
        $cart = array_diff($cart, [$productId]);
        session(['cart' => array_values($cart)]);
        
        return redirect()->route('cart')->with('success', 'Produit retiré du panier');
    }

    /**
     * Place an order for a product
     */
    public function placeOrder(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour commander');
        }

        $telephone = session('user_telephone', auth()->user()->telephone);

        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'telephone' => $telephone,
            'status' => 'pending',
        ]);

        // Remove from cart if it was there
        $cart = session('cart', []);
        $cart = array_diff($cart, [$productId]);
        session(['cart' => array_values($cart)]);

        return redirect()->route('home')->with('success', 'Commande passée avec succès ! Nous vous contacterons bientôt.');
    }
}
