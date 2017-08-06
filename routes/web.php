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

config(['app.timezone' => 'Asia/Kuala_Lumpur']);

$app->get('/', function (Request $request) use ($app) {
    return response([
        "message" => sprintf("Enter phone number with country code parameter 1 without dash example %s/60123456789 and you can use query string for add text ?text=Hello", $request->root())
    ]);
});

$app->get('/{phone:[+-]?[0-9]{1,13}}', function ($phone, Request $request) use ($app) {

    $request->request->add(['phone' => (int)$phone]);

    $this->validate($request, [
        'name' => 'string|max:255',
        'text' => 'string',
        'phone' => 'required|integer',
    ]);

    $name = $request->get('name');
    $text = $request->get('text');
    $phone = $request->get('phone');

    Datas::create([
        'name' => $name ?? null,
        'text' => $text ?? null,
        'phone' => $phone,
    ]);

    $redirect_url = sprintf("https://api.whatsapp.com/send?phone=%d&text=%s", $phone, $text);

    return redirect($redirect_url);
});