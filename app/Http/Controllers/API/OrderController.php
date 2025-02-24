<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Pizza;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class OrderController extends BaseController
{
    //
    public function sendOrder(Request $request){
        $input = $request->all();

        //Megredendelési adatok validálása
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'tel' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string',
            'termsAccepted' => 'required|boolean',
            'pizzas' => 'required|array',
        ]);
        $pizzas = $input['pizzas'];

        //Népszerűség növelése rendelésnél
        foreach($pizzas as $pizzaId => $quantity){
            $pizza = Pizza::find($pizzaId);
            if($pizza){
                $pizza->popularity += $quantity;
                $pizza->save();
            }
        }

        //Mail elküldése
        //!!kell hogy legyen env-ben beállítve egy működő email szerver!!
        Mail::to($input['email'])->send(new OrderMail($input));

        return $this->sendResponse($pizzas, 'Megrendelés sikeresen elküldve.');
    }
}
