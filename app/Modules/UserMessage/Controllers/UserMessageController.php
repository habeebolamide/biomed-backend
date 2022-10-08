<?php

namespace App\Modules\UserMessage\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\UserMessage\Requests\CreateUserMessageRequest;
use App\Modules\UserMessage\Services\UserMessagesService;

class UserMessageController extends Controller
{
    public function store(CreateUserMessageRequest $request)
    {
       return (new UserMessagesService)->createMessage($request->validated());
    }
}
