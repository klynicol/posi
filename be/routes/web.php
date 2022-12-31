<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductCollectionController;
use App\Http\Controllers\ProductCollectionProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ProductReviewProductController;
use App\Http\Controllers\ProductTagController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

@author Mark Wickline 2022-12-11

We don't need the form routes for the API:
    this includes
    public function create()
    public function edit($id)
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resources([
    'customers' => CustomerController::class,
    'products' => ProductController::class,
    'orders' => OrderController::class,
    'services' => ServiceController::class,
    'product_collections' => ProductCollectionController::class,
    'product_categories' => ProductCategoryController::class,
    'product_reviews' => ProductReviewController::class,
    'product_tags' => ProductTagController::class,
]);

/** Define and generate some resources for join tables. */
function apiJoinResource(string $one, string $two, string $controller_class)
{
    Route::get("{$one}s/{{$one}}/{$two}s", [$controller_class, 'index']);
    Route::get("{$one}s/{{$one}}/{$two}s/{{$two}}", [$controller_class, 'show']);
    Route::post("{$one}s/{{$one}}/{$two}s/{{$two}}", [$controller_class, 'store']);
    Route::put("{$one}s/{{$one}}/{$two}s/{{$two}}", [$controller_class, 'update']);
    Route::delete("{$one}s/{{$one}}/{$two}s/{{$two}}", [$controller_class, 'destroy']);
};

apiJoinResource('product', 'review', ProductReviewProductController::class);
apiJoinResource('product', 'collection', ProductCollectionProductController::class);
