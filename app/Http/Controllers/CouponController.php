<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
  public function use()
  {
    request()->validate([
      'coupon' => 'required|numeric|digits:6'
    ]);

    $coupon = Coupon::where('coupon', request('coupon'))->first();

    if (!$coupon) {
      return response([
        'message' => 'Купон под таким номером не существует'
      ], 404);
    }

    if ($coupon->is_used) {
      return response([
        'message' => 'Купон уже применен'
      ], 409);
    }

    $coupon->is_used = true;
    $coupon->update();

    return $coupon;
  }
}
