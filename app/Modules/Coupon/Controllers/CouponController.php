<?php

namespace App\Modules\Coupon\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Coupon\Requests\GenerateCouponRequest;
use App\Modules\Coupon\Requests\UserCouponRequest;
use App\Modules\Coupon\Services\CouponServices;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function getCoupon($coupon)
    {
        return (new CouponServices)->getCoupon($coupon);
    }
    public function getAllCoupon(Request $request)
    {
        return (new CouponServices)->getAllCoupon($request);
    }

    public function generateCoupon(GenerateCouponRequest $request)
    {
        return (new CouponServices)->generateCoupon($request);
    }

    public function attatchToUser($id, $user_id)
    {
        return (new CouponServices)->attachToUser(['id'=>$id, 'user_id'=>$user_id]);
    }

    public function userCoupon($id,UserCouponRequest $request)
    {
        return (new CouponServices)->findMyCoupon($request, $id);
    }

    public function isCouponActive($coupon)
    {
        return (new CouponServices)->isCouponActive($coupon);
    }
}
