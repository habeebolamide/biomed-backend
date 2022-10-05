<?php

namespace App\Modules\Coupon\Services;

use App\Modules\Coupon\Models\Coupon;
use App\Traits\ApiResponseMessagesTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $this->success($coupon->orderBy('created_at', 'desc')->paginate(20), "Coupon Fetched Successfully");
    }

    public function generateCoupon($data)
    {
       for($i = 0; $i < $data->count; $i++){
        $coupon = $this->generateCoupons(2);
        Coupon::create([
            'coupon' => $coupon,
            'description' => $data->description,
            'percent' => $data->percent,
            'no_of_usage' => $data->no_of_usage,
            'expires_at' => $data->expires_at
        ]);
       }

       return $this->success([], "Coupon Created Successfully");


    }

    public function attachToUser($data)
    {
        if(!DB::table('users')->where('id', $data['user_id'])->exists()) return $this->badRequest('Could not find reference to the given user');

        if(!DB::table('coupons')->where('id', $data['id'])->exists()) return $this->badRequest('Could not find reference to the given user');

        $updateCount= Coupon::where('id', $data['id'])->update([
            'user_id' => $data['user_id']
        ]);

        if($updateCount > 0) return  $this->success([], "Coupon Attached Successfully");
        return $this->badRequest('Something went wrong while attaching coupon to user.');

    }

    public function findMyCoupon($data, $id)
    {
       $coupon= Coupon::where(['coupon'=> $data["coupon"], 'user_id' => $id])->first();

       if(blank($coupon)) return $this->badRequest('Coupon not found .');
       if($coupon->status !='active') $this->badRequest('Coupon is not active .');

       return  $this->success($coupon, "User Coupon");

    }

    public function isCouponActive($coupon)
    {
       
    }


}