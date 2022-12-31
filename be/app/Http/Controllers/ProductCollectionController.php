<?php

namespace App\Http\Controllers;

use App\Models\ProductCollection as ProductCollectionModel;
use Illuminate\Http\Request;

class ProductCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->jsonResponse(ProductCollectionModel::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection_id = ProductCollectionModel::create($request->all())->id;
        return $this->jsonResponse($collection_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCollectionModel  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCollectionModel $collection)
    {
        return $this->jsonResponse($collection->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCollectionModel  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCollectionModel $collection)
    {
        $collection->update($request->all());
        return $this->jsonResponse($collection->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCollectionModel  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCollectionModel $collection)
    {
        $collection->delete();
        return $this->jsonResponse('', 'Collection deleted');
    }
}
