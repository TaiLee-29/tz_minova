<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate(5);

        return view('pages.index', compact('products' ));

    }
    public function create()
    {
        $product = new Product();

        return view('pages.form', compact('product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request['title'];
        $product->description = $request['description'];
        $product->user_id = Auth::id();
        $product->save();

        return new RedirectResponse('/'.$product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     *
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('pages.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     *
     */
    public function edit(Product $product)

    {
        if ($this->authorize('update', $product)) {
            return view('pages.form', compact('product'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     *
     */
    public function update(Request $request, Product $product)
    {
        // $product->update($request->only('title', 'description'));
        if ($this->authorize('update', $product)) {
            $product->name = $request['name'];
            $product->description = $request['description'];
            $product->save();


            return redirect()->route('show', $product);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     *
     */
    public function destroy(Product $product)
    {
        if ($this->authorize('delete', $product)) {
            $product->delete();

            return redirect()->route('index');
        }
    }
}
