<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $editableProduct = null;
        $q = $request->get('q');
        $products = Product::where(function ($query) use ($q) {
            if ($q) {
                $query->where('name', 'like', '%'.$q.'%');
            }
        })
            ->orderBy('name')
            ->paginate(25);

        if (in_array($request->get('action'), ['edit', 'delete']) && $request->has('id')) {
            $editableProduct = Product::find($request->get('id'));
        }

        return view('products.index', compact('products', 'editableProduct'));
    }

    public function store(Request $request)
    {
        $newProduct = $request->validate([
            'name'         => 'required|max:20',
            // 'cash_price'   => 'required|numeric',
            // 'credit_price' => 'nullable|numeric',
            // 'unit_id'      => 'required|numeric|exists:product_units,id',
        ]);

        $requestData = $request->all();

        Product::create($requestData);

        flash(trans('product.created'), 'success');

        return redirect()->route('products.index');
    }

    public function update(Request $request, Product $product)
    {
        $productData = $request->validate([
            'name'         => 'required|max:20',
            // 'cash_price'   => 'required|numeric',
            // 'credit_price' => 'nullable|numeric',
            // 'unit_id'      => 'required|numeric|exists:product_units,id',
        ]);

        $requestData = $request->all();

        $routeParam = $request->only('page', 'q');

        $product->update($requestData);

        flash(trans('product.updated'), 'success');

        return redirect()->route('products.index', $routeParam);
    }

    public function destroy(Request $request, Product $product)
    {
        $requestData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $routeParam = $request->only('page', 'q');

        if ($requestData['product_id'] == $product->id && $product->delete()) {
            flash(trans('product.deleted'), 'success');

            return redirect()->route('products.index', $routeParam);
        }

        flash(trans('product.undeleted'), 'error');

        return back();
    }

    public function priceList()
    {
        $products = Product::orderBy('name')->with('unit')->get();

        return view('products.price-list', compact('products'));

        // $pdf = \PDF::loadView('products.price-list', compact('products'));
        // return $pdf->stream('price-list.pdf');
    }

    public function getAllProduct()
    {
        $data = Product::get();

        $response = [
            'data' => $data
        ];

        return response()->json($response);
    }

    public function getProduct($barcode)
    {
        $data = Product::where("barcode", 'LIKE', '%'.$barcode.'%')->get();

        $response = [
            'data' => $data
        ];

        return response()->json($response);
    }

    public function storeProduct(Request $request)
    {
        Product::create([
            'name' => "dari background proc", 
            'barcode' => date("is"),
            'pcs_price' => date("i") . 00,
            'dozen_price' => 4000,
            'pack_price' => 5000,
            'box_price' => 6000
        ]);

        $response = [
            'data' => "sukses"
        ];

        return response()->json($response);
    }

}