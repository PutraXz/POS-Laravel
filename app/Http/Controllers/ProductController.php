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
            'image' => 'required|file|mimes:jpg,jpeg,png,fig,webp',
            'stock' => 'required|integer',
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
        ->editColumn('price', fn ($p) => number_format($p->price, 0, ',', '.'))
        ->addColumn('image', function ($p) {
            $src = asset('img_product/'.$p->image);
            return '<img src="'.$src.'" alt="'.$p->name_product.'" width="75" class="img-thumbnail">';
        })
        ->addColumn('action', function ($p) {
            return '
                <button class="btn btn-sm btn-primary edit" data-id="'.$p->id.'">Edit</button>
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
