<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    //Üzenet küldése...
    public function sendMessage(Request $request){

        return $this->sendResponse($request, 'Üzenet sikeresen elküldve.');
    }
}
