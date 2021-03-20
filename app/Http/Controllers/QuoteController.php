<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use App\Models\Quote;
use App\Models\Character;
use App\Events\ApiRequest;

class QuoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:20,1');
        
        event(new ApiRequest());
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::paginate(10);
        
        if (! $quotes) {
            return responder()
            ->error()
            ->respond();
        }
        
        return responder()
        ->success($quotes)
        ->respond();       
    }

    /**
     * Display a random of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random(Request $request)
    {
        //в условии не уточнено - полное имя или по вхождению
        //если по вхождению
        $quotesCharacter = Character::where('name', 'like', '%' . $request->author . '%')
                           ->with(['quotes' => function($query){
                               $query->orderBy(\DB::raw('RAND()'))->take(1);
                           }])
                           ->orderBy(\DB::raw('RAND()'))
                           ->take(1)
                           ->first();

        //если полное имя
        //$quotesCharacter = Character::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$request->author])... 
                          
        if (count($quotesCharacter->quotes)) 
            $quote[] = $quotesCharacter->quotes[0]['quote'];
        
        
        if (! isset($quote)) {
            return responder()
            ->error()
            ->respond();
        }
        
        return responder()
        ->success($quote)
        ->respond();
    }
}
