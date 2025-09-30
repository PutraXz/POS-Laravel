<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Tambahkan ini

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Variabel $product tidak digunakan oleh DataTables, jadi bisa dihapus atau dikosongkan
        // Namun, jika view 'product' membutuhkan data ini, biarkan saja.
        return view('product');
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
            'image' => 'required|file|mimes:jpg,jpeg,png,webp', // Hapus 'fig' karena itu format desain
            'stock' => 'required|integer',
            'kategori' => 'required|string',
        ]);

        $filename = time().'_'.Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img_product'), $filename);

        $req = $request->toArray();
        $req['image'] = $filename;
        Product::create($req);

        return back()->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource (for edit prefill).
     */
    public function get(Product $product)
    {
        return response()->json([
            'ok' => true,
            'data' => $product,
            'image_url' => asset('img_product/'.$product->image),
        ]);
    }

    /**
     * DataTables source.
     */
    public function show()
    {
       return DataTables::of(Product::query())
            ->addIndexColumn()
            ->editColumn('price', fn ($p) => 'Rp'.number_format($p->price, 0, ',', '.'))
            ->addColumn('image', function ($p) {
                $src = asset('img_product/'.$p->image);
                return '<img src="'.$src.'" alt="'.e($p->name_product).'" width="75" class="img-thumbnail">';
            })
->addColumn('action', function ($p) {
    $deleteUrl = route('products.destroy', $p->id);

    return '
      <div class="d-flex align-items-center gap-2">
        <button type="button"
                class="btn btn-primary btn-sm edit"
                data-id="'.$p->id.'"
                data-bs-toggle="modal"
                data-bs-target="#editModal">
          <i class="fa fa-pen"></i> Edit
        </button>

        <form action="'.$deleteUrl.'" method="POST" class="m-0 p-0"
              onsubmit="return confirm(\'Hapus produk ini?\')">
          '.csrf_field().method_field('DELETE').'
          <button type="submit"
                  class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i> Hapus
          </button>
        </form>
      </div>
    ';
})


            ->rawColumns(['image','action'])
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
       // validasi: image opsional saat update
        $request->validate([
            'name_product' => 'required|string',
            'price'        => 'required|integer',
            'image'        => 'nullable|file|mimes:jpg,jpeg,png,webp',
            'stock'        => 'required|integer',
            'kategori'     => 'required|string',
        ]);

        $data = $request->only(['name_product','price','stock','kategori']);

        // handle image jika diupload
        if ($request->hasFile('image')) {
            // hapus file lama (jika ada)
            if ($product->image && File::exists(public_path('img_product/'.$product->image))) {
                File::delete(public_path('img_product/'.$product->image));
            }
            $filename = time().'_'.Str::slug(pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('img_product'), $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return response()->json([
            'ok'   => true,
            'msg'  => 'Product updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    if ($product->image && file_exists(public_path('img_product/'.$product->image))) {
        @unlink(public_path('img_product/'.$product->image));
    }
    $product->delete();

    return back()->with('success', 'Produk berhasil dihapus.');
}

}