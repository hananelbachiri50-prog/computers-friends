<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $recentOrders = Order::with(['user', 'product'])->latest()->take(5)->get();
        
        // Most ordered product
        $mostOrderedProduct = Order::select('product_id')
            ->selectRaw('count(*) as order_count')
            ->groupBy('product_id')
            ->orderByDesc('order_count')
            ->first();
        
        $mostOrdered = null;
        if ($mostOrderedProduct) {
            $mostOrdered = Product::find($mostOrderedProduct->product_id);
            $mostOrdered->order_count = $mostOrderedProduct->order_count;
        }

        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders', 'recentOrders', 'mostOrdered'));
    }

    /**
     * Display users list
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Toggle user active status
     */
    public function toggleUserStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        
        $message = $user->active ? 'Utilisateur activé avec succès' : 'Utilisateur désactivé avec succès';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Impossible de supprimer un administrateur');
        }
        
        $user->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé avec succès');
    }

    /**
     * Display products list
     */
    public function products()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show create product form
     */
    public function createProduct()
    {
        return view('admin.products.create');
    }

    /**
     * Store new product
     */
    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'specs' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'required|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
        ]);

        // Handle main image
        $imgPath = $request->file('img')->store('products', 'public');
        
        // Handle gallery images
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
        }

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'specs' => $validated['specs'],
            'description' => $validated['description'] ?? null,
            'img' => $imgPath,
            'gallery' => $galleryPaths,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Show edit product form
     */
    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update product
     */
    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'specs' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
        ]);

        // Handle main image update
        if ($request->hasFile('img')) {
            // Delete old image
            if ($product->img) {
                Storage::disk('public')->delete($product->img);
            }
            $validated['img'] = $request->file('img')->store('products', 'public');
        }

        // Handle gallery update
        if ($request->hasFile('gallery')) {
            // Delete old gallery images
            $oldGallery = $product->gallery ?? [];
            foreach ($oldGallery as $image) {
                Storage::disk('public')->delete($image);
            }
            
            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Produit modifié avec succès');
    }

    /**
     * Delete product
     */
    public function deleteProduct(Product $product)
    {
        // Delete images
        if ($product->img) {
            Storage::disk('public')->delete($product->img);
        }
        
        $gallery = $product->gallery ?? [];
        foreach ($gallery as $image) {
            Storage::disk('public')->delete($image);
        }

        $product->delete();
        return redirect()->back()->with('success', 'Produit supprimé avec succès');
    }

    /**
     * Display orders list
     */
    public function orders()
    {
        $orders = Order::with(['user', 'product'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Order $order, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->back()->with('success', 'Statut de la commande mis à jour');
    }
}