<?php

namespace App\Modules\Coupon\Services;

use App\Modules\Coupon\Models\Coupon;
use App\Traits\ApiResponseMessagesTrait;
use Carbon\Carbon;

class CouponServices
{
    use ApiResponseMessagesTrait;

    public function getCoupon($coupon)
    {
        $coupon = Coupon::where('coupon', $coupon)->first();
        return $this->success($coupon, "Coupon Fetched Successfully");
    }

    public function generateCoupon($data)
    {
       for($i = 0; $i < $data->count; $i++){
        $coupon = $this->generateCoupons(10);
        Coupon::create([
            'coupon' => $coupon,
            'description' => $data->description,
            'percent' => $data->percent,
            'amount' => $data->amount,
            'expires_at' => Carbon::now()
        ]);
       }
    }

    public function isCouponActive($coupon)
    {
       
    }
}