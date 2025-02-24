<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Http\Resources\PizzaResource;
use App\Models\Pizza;
use Validator;

class PizzaController extends BaseController
{

    public function getPizzas(Request $request)
    {
        //Validálás
        $input = $request->all();

        $validator = Validator::make($input, [
            'orderby' => 'string',
            'order' => 'string',
            'page' => 'integer|min:1',
            'per_page' => 'integer|min:1',
            'search' => 'string'
        ]);        

        //Lekérdezés elkészítése
        $query = Pizza::query();

        //Keresés
        if (isset($input['search'])) {
            $query->where('name', 'LIKE', '%' . $input['search'] . '%');
        }

        //Rendezés
        if (isset($input['orderby'])) {
            $order = $input['order'];
            $query->orderBy($input['orderby'], $order);
        }

        //Lapozás, alapértelmezetten 10-esével és 0.-oldalról
        $page = isset($input['page']) ? $input['page'] : 0;
        $perPage = isset($input['per_page']) ? $input['per_page'] : 10;
        $pizzas = $query->paginate($perPage, ['*'], 'page', $page);
    
        return $this->sendResponse(['pizzas' => PizzaResource::collection($pizzas),'totalpages' => $pizzas->lastPage()], 'Keresett pizzák sikeresen lekérdve.');
    }

    public function basketInfo(Request $request){

        //Validálás
        $input = $request->all();

        $validator = Validator::make($input, [
            'inbasket' => 'required|array' 
        ]);

        //Kigyűjtjük a pizzákat id-k alapján query-be
        $inBasketData = collect($input['inbasket'])->mapWithKeys(function($quantity, $id) {
            return [(int)$id => $quantity];
        });
        $query = Pizza::whereIn('id', $inBasketData->keys());
        
        //Pizzas-ba bele tesszük a id-k hez tartozó pizzákat és hozzá quantity-t
        $pizzas = $query->get()->map(function ($pizza) use ($inBasketData) {
            $pizza->quantity = $inBasketData[$pizza->id];
            return $pizza;
        });

        //Kiszámoljuk hogy mennyibe kerülnek a pizzák sumtotal mezőbe
        $sumtotal = $pizzas->sum(function ($pizza) {
            return $pizza->quantity * $pizza->price;
        });

        $pizzatotal = $pizzas->sum(function ($pizza) {
            return $pizza->quantity;
        });
    
        return $this->sendResponse(['pizzas'=>PizzaResource::collection($pizzas), 'sumtotal'=>$sumtotal, 'pizzatotal'=>$pizzatotal], 'Pizzák kosár sikeresen lekérdve.');
    }
}
