<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Category;
use Storage;
use App\Models\Shop;
use App\Models\User;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $shopId = auth()->user()->shop_id;

        $queryProducts = Product::where('shop_id', $shopId)
            ->orderBy('created_at', 'DESC')
            // ->with('category');
            ;

        $search = $request->input('search');
        if (!empty($search)) {
            $queryProducts->where('name', 'like', '%' . $search . '%');
        }

        $products = $queryProducts->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        // $categories = Category::all();
        // return view('products.create', compact('categories'));
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'price' => 'required|numeric',
            // 'stock' => 'required|numeric',
            // 'category_id' => 'required',
            'description' => 'required',
        ]);

        $validated['stock'] = 0; // default stock kalau form tidak menyediakan

        $shopId = auth()->user()->shop_id;

        $image = $request->file('image');
        $filename = date('Y-m-d') . '-' . time() . '-' . $image->getClientOriginalName();
        $path = 'image-products/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($image));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => 0, // tambahkan ini!
            // 'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path,
            'shop_id' => $shopId,
        ]);

        return redirect()->route('products')->with('success', 'Berhasil menambah produk');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        // $category = Category::find($product->category_id);
        // return view('products.show', compact('product', 'category'));
        return view('products.show', compact('product'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        // $categories = Category::all();
        // return view('products.edit', compact('product', 'categories'));
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'price' => 'required|numeric',
            // 'stock' => 'required|numeric',
            // 'category_id' => 'required',
            'description' => 'required',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('Y-m-d') . '-' . time() . '-' . $image->getClientOriginalName();
            $path = 'image-products/' . $filename;

            Storage::disk('public')->put($path, file_get_contents($image));
            $product->image = $path;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        // $product->stock = $request->stock;
        // $product->category_id = $request->category_id;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('products')->with('success', 'Berhasil mengupdate produk');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products')->with('success', 'Berhasil menghapus produk');
    }

    public function apiIndex(Request $request)
    {
        try {
            $products = Product::select('id', 'name', 'image', 'price')
                ->orderBy('created_at', 'DESC')
                ->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => asset(Storage::url($product->image))
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $products
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getProductsByShopId(Request $request)
    {
        $shopId = $request->query('shop_id');

        $products = Product::where('shop_id', $shopId)
            ->select('id', 'name', 'image', 'price')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset(Storage::url($product->image))
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Data toko berhasil tampil',
            'data' => $products
        ]);
    }

    public function getProductDetail(Request $request)
    {
        $shopId = $request->query('shop_id');
        $shop = Shop::find($shopId);

        if (!$shop) {
            return response()->json([
                'success' => false,
                'message' => 'Toko tidak ditemukan',
                'data' => null
            ], 404);
        }

        $products = Product::where('shop_id', $shopId)
            ->select('id', 'name', 'image', 'price', 'description')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset(Storage::url($product->image)),
                    'description' => $product->description
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Data toko dan produk berhasil tampil',
            'data' => [
                'shop' => [
                    'id' => $shop->id,
                    'name' => $shop->name,
                    'foto_toko' => asset(Storage::url($shop->foto_toko))
                    // 'description' => $shop->description
                ],
                'products' => $products
            ]
        ]);
    }

    public function getSingleProductDetail($product_id)
    {
        $product = Product::with('shop')->find($product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data toko dan produk berhasil tampil',
            'data' => [
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => asset(Storage::url($product->image)),
                    'description' => $product->description,
                    'shop_id' => $product->shop ? $product->shop->id : null,
                    'shop' => $product->shop ? [
                        'id' => $product->shop->id,
                        'name' => $product->shop->name,
                        'foto_toko' => asset(Storage::url($product->shop->foto_toko)),
                        // 'link_wa' => $product->shop->link_wa,
                        // 'link_gmaps' => $product->shop->link_gmaps,
                        // 'link_marketplace' => $product->shop->link_marketplace,
                    ] : null
                ]
            ]
        ]);
    }
}
