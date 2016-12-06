<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
/*use Illuminate\Support\Facades\Validator;*/
use Illuminate\Support\Facades\Input;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       /* \Validator::extend('greater_than', function($attribute, $value, $parameters) { $other = Input::get($parameters[0]);

            return isset($other) and intval($value) > intval($other);
        });

        \Validator::extend('less_than', function($attribute, $value, $parameters)
        {
            $other = Input::get($parameters[0]);

            return isset($other) and intval($value) < intval($other);
        });*/
        \Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
       $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value >= $min_value;
        });

        \Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });
    }

    


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
