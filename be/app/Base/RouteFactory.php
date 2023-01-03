<?php

namespace App\Base;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/**
 * Class RouteFactory
 * 
 * @author Mark Wickline 2023-01-02
 * 
 * Used to quicky generate routes for either a controller or a model.
 * These routes will be very generic in structure and will only allow
 * for the basic CRUD operations.
 * 
 * will accept 1-2 models or 1 controller.
 * 
 * @param string $controller
 * @param array $models
 * @param array $slugs
 * @param array $storeValidationRules
 * @param array $updateValidationRules
 */
class RouteFactory
{
    public static array $storeValidationRules = [];
    public static array $updateValidationRules = [];
    public static array $slugs = [];
    public static array $_models = [];
    public static string|null $controller = null;

    /**
     * Generate the routes for a controller.
     * 
     * @param string $controller
     * @param array $slugs
     * @return object
     */
    public static function controller(string $controller, array $slugs)
    {
        self::$controller = $controller;
        self::$slugs = $slugs;
        return new static();
    }

    /**
     * Generate the routes for a controller.
     * 
     * @param array $models
     * @param array $slugs
     * @return object
     */
    public static function models(array $models, array $slugs)
    {
        self::$_models = $models;
        self::$slugs = $slugs;
        return new static();
    }

    /**
     * Generate the routes for a controller.
     * 
     * @param array $validationRules
     * @return object
     */
    public static function validate(array $validationRules)
    {
        self::$storeValidationRules = $validationRules;
        self::$updateValidationRules = $validationRules;
        return new static();
    }

    /**
     * Set the validation rules for the store method.
     * 
     * @param array $validationRules
     * @return object
     */
    public static function validateStore(array $validationRules)
    {
        self::$storeValidationRules = $validationRules;
        return new static();
    }

    /**
     * Set the validation rules for the update method.
     * 
     * @param array $validationRules
     * @return object
     */
    public static function validateUpdate(array $validationRules)
    {
        self::$updateValidationRules = $validationRules;
        return new static();
    }

    /**
     * Generate the routes.
     * 
     * @return void
     */
    public static function generate()
    {
        if (self::$controller) {
            self::generateControllerRoutes();
        } else if (!empty(self::$_models)) {
            if(count(self::$_models) == 1){
                self::generateModelRoutes();
            } else {
                self::generateModelRoutesJoin();
            }
        }
    }

    private static function generateControllerRoutes()
    {
    }

    /**
     * Generate routes for a single model, with model binding.
     * 
     * @return void
     */
    private static function generateModelRoutes()
    {
        $slugs = self::$slugs;
        $models = self::$_models;

        $name = "{$slugs[0]}s";
        
        // "index"
        Route::get($name, function () use ($models) {
            return Controller::jsonResponseStatic(
                $models[0]::all()->toArray()
            );
        });
        // "store"
        Route::post($name, function () use ($models) {
            $newModel = $models[0]::create(request()->all());
            return Controller::jsonResponseStatic(
                $newModel->toArray()
            );
        });

        $name .= "/{{$slugs[0]}}";

        // "show"
        Route::get($name, function ($modelInstance) use ($models) {
            return Controller::jsonResponseStatic(
                $modelInstance->toArray()
            );
        });
        // "update"
        Route::put($name, function ($modelInstance) use ($models) {
            $modelInstance->update(request()->all());
            return Controller::jsonResponseStatic(
                $modelInstance->toArray()
            );
        });
        // "destroy"
        Route::delete($name, function ($modelInstance) use ($models) {
            $modelInstance->delete();
            return Controller::jsonResponseStatic(
                '',
                'Model deleted successfully.'
            );
        });
    }

    private static function generateModelRoutesJoin()
    {
        // $slugs = self::$slugs;
        // $models = self::$models;

        // $name = "{$slugs[0]}s/{{$slugs[0]}}/{$slugs[1]}s";
        
        // // "index"
        // Route::get("{$slug}s", function () use ($models) {
        //     return $model::all();
        // });
        // // "store"
        // Route::post("{$slug}s", function () use ($model) {
        //     return $model::create(request()->all());
        // });

        // $name .= "/{{$slugs[1]}}";

        // if(count($slugs) > 1) {
        //     $name .= "{$slugs[1]}s/{{$slugs[1]}}";
        // }

        // // "show"
        // Route::get("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        //     return $modelInstance;
        // });
        // // "update"
        // Route::put("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        //     $modelInstance->update(request()->all());
        //     return $modelInstance;
        // });
        // // "destroy"
        // Route::delete("{$slug}s/{{$slug}}", function ($modelInstance) use ($model) {
        //     $modelInstance->delete();
        //     return $modelInstance;
        // });
    }
}
