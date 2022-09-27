<?php

namespace App\Modules\Coupon\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Coupon\Requests\GenerateCouponRequest;
use App\Modules\Coupon\Services\CouponServices;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function getCoupon($coupon)
    {
        return (new CouponServices)->getCoupon($coupon);
    }

    public function generateCoupon(GenerateCouponRequest $request)
    {
        return (new CouponServices)->generateCoupon($request);
    }

    public function isCouponActive($coupon)
    {
        return (new CouponServices)->isCouponActive($coupon);
    }
}
