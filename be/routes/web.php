<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Models;
use App\Base\RouteFactory;

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

/**
 * Generate crud routes with controller.
 * 
 * @param string $slug
 * @param string $controller
 * @return void
 */
function controllerResourceRoute(string $slug, string $controller)
{
    Route::resource("{$slug}s", $controller)->except(['create', 'edit']);
}


$controllerResourceRoutes = [
    'setting' => Controllers\Setting::class,
];

foreach ($controllerResourceRoutes as $slug => $controller) {
    controllerResourceRoute($slug, $controller);
}


/**
 * Generate crud routes with model binding.
 * 
 * @param string $slug
 * @param string $model
 * @return void
 */
function modelResourceRoute($slug, $model)
{
    // "index"
    Route::get("{$slug}s", function () use ($model) {
        return $model::all();
    });
    // "show"
    Route::get("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        return $modelInstance;
    });
    // "store"
    Route::post("{$slug}s", function () use ($model) {
        return $model::create(request()->all());
    });
    // "update"
    Route::put("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        $modelInstance->update(request()->all());
        return $modelInstance;
    });
    // "destroy"
    Route::delete("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        $modelInstance->delete();
        return $modelInstance;
    });
}

$modelResourceRoutes = [
    // 'customer' => Models\Customer::class,
    'product' => Models\Product::class,
    'order' => Models\Order::class,
    'service' => Models\Service::class,
    'product_collection' => Models\ProductCollection::class,
    'product_categorie' => Models\ProductCategory::class,
    'product_review' => Models\ProductReview::class,
    'product_tag' => Models\ProductTag::class,
];

foreach ($modelResourceRoutes as $slug => $model) {
    modelResourceRoute($slug, $model);
}

// More specific routes

Route::get(
    'settings/{code}/{codeAlt}',
    [Controllers\Setting::class, 'showByCode']
);

RouteFactory::models([Models\Customer::class], ['customer'])->generate();
