<?php
namespace App\Helpers;

class Helpers {

    public function debug_variable_helper($result) {
        dd($result);
    }

    public function app_name() {
        return config('app.name');
    }
}