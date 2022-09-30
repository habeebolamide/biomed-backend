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

    public function getAllCoupon($data)
    {
        $coupon = Coupon::select('*');
        if($data["filters"]) {
            if(array_key_exists("name", $data["filters"])) {
                $coupon->where('coupon', "like", "%".$data["filters"]["name"]."%");
                
            }
            if(array_key_exists("status", $data["filters"])) {
                $coupon->where('status',$data["filters"]["status"]);
                
            }

        }
        return $this->success($coupon->paginate(20), "Coupon Fetched Successfully");
    }

    public function generateCoupon($data)
    {
       for($i = 0; $i < $data->count; $i++){
        $coupon = $this->generateCoupons(10);
        Coupon::create([
            'coupon' => $coupon,
            'description' => $data->description,
            'percent' => $data->percent,
            // 'amount' => $data->amount,
            'expires_at' => $data->expires_at
        ]);
       }

       return $this->success([], "Coupon Created Successfully");


    }

    public function isCouponActive($coupon)
    {
       
    }
}