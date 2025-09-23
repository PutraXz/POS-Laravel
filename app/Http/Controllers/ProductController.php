<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('product', compact('product'));
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
        $request->validate([
            'name_product' => 'required|string',
            'price' => 'required|integer',
            'image' => 'required|file|mimes:jpg,jpeg,png,fig,webp',
            'stock' => 'required|integer',
            'kategori' => 'required|string',
        ]);
        $filename = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('img_product'), $filename);
        $req = $request->toArray();
        $req['image'] = $filename;
        Product::create($req);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       return DataTables::of(Product::query())
        ->addIndexColumn()
        ->editColumn('price', fn ($p) => 'Rp'.number_format($p->price, 0, ',', '.'))
        ->addColumn('image', function ($p) {
            $src = asset('img_product/'.$p->image);
            return '<img src="'.$src.'" alt="'.$p->name_product.'" width="75" class="img-thumbnail">';
        })
        ->addColumn('action', function ($p) {
    return '
        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-product-'.$p->id.'">Edit</button>
        <button class="btn btn-sm btn-danger delete" data-id="'.$p->id.'">Hapus</button>
    ';
})

        ->rawColumns(['image','action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

    $request->validate([
        'name_product' => 'required|string',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'kategori' => 'required|string',
        'image' => 'nullable|file|mimes:jpg,jpeg,png,fig,webp'
    ]);

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        $oldImagePath = public_path('img_product/' . $product->image);
        if (File::exists($oldImagePath)) {
            File::delete($oldImagePath);
        }

        $filename = time().'.'.$request->image->getClientOriginalName();
        $request->image->move(public_path('img_product'), $filename);
        $product->image = $filename;
    }

    $product->name_product = $request->name_product;
    $product->price = $request->price;
    $product->stock = $request->stock;
    $product->kategori = $request->kategori;

    $product->save();

    return redirect()->back()->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

    // Hapus gambar dari server
    $imagePath = public_path('img_product/' . $product->image);
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
    }
}
