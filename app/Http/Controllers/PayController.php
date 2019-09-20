<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Paystack;
class PayController extends Controller
{
    //
public function verify(Request $request){
$pay = new Paystack;
$details = $pay->verify($request->input('reference'));
return dd($details);
}
}
