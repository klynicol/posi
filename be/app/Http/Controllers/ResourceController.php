<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * This is a generic controller for resources.
 * 
 * It is intended to be extended by other controllers.
 * 
 * @author Mark Wickline
 * @version 2022-12-11
 */
class ResourceController extends Controller
{
    /**
     * The model to use for this controller
     * example => const MODEL = Product::class;
     * 
     * @var string
     */
    const MODEL = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->jsonResponse(static::MODEL::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product_id = static::MODEL::create($request->all())->id;
        return $this->jsonResponse($product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(static::MODEL $product)
    {
        return $this->jsonResponse($product->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return $this->jsonResponse($product->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->jsonResponse('', 'Product deleted');
    }
}