<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;
use App\Datas;

$app->get('/', function (Request $request) use ($app) {
    return response()->json([
        "message" => sprintf("enter phone number with country code parameter 1 without dash example %s/60123456789", $request->root()),
    ]);
});

$app->get('/{phone:[+-]?[0-9]{1,13}}', function ($phone) use ($app) {

    $phone = (integer)$phone;

    if (is_integer($phone)) {

        $data = Datas::create(['phone' => $phone]);
        $redirect_url = sprintf("https://api.whatsapp.com/send?phone=%d&text=Hello", $data->phone);

        return redirect($redirect_url);
    }

    return redirect('/');
});