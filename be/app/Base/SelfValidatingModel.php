<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

/**
 * Class SelfValidatingModel
 *
 * @author Mark Wickline 2022-12-29
 * 
 * @package App\Base
 * 
 * @see https://github.com/minuteoflaravel/laravel-self-validating-model/blob/main/src/SelfValidatingModel.php
 * 
 * Provides an easy way to add validation to your models by defining a rules property.
 * 
 * @property array $rules
 */
class SelfValidatingModel extends Model {
    public $rules = [];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            Validator::make($model->toArray(), $model->rules)->validate();
        });
    }
}