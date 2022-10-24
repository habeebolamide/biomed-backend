<?php

namespace App\Modules\UserMessage\Services;

use App\Modules\Auth\Models\User;
use App\Modules\UserMessage\Models\CustomerMesages;
use App\Traits\ApiResponseMessagesTrait;
use Illuminate\Support\Facades\DB;

class UserMessagesService
{
     use ApiResponseMessagesTrait;


     public function createMessage($data)
     {
          $validate_user = User::where('id', $data['user_id'])->firstOrFail();
          $validate_user2 = User::where('id', $data['sender_id'])->firstOrFail();

          $create_message = CustomerMesages::create([
               'sender_id' => $data["sender_id"],
               'user_id' => $data["user_id"],
               'messages' => $data["messages"],
          ]);

          if ($create_message)
               return $this->success($create_message->fresh(), "Message sent successfully Created Successfully");
          return $this->badRequest("Unable to send Message");
     }
}
