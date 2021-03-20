<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Flugg\Responder\Responder;
use App\Models\Character;
use App\Events\ApiRequest;

class CharacterController extends Controller
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
    public function index(Request $request)
    {
        if ($request->name) {
            //в условии не уточнено - полное имя или по вхождению
            //если по вхождению
            $characters = Character::where('name', 'like', '%' . $request->name . '%')
                          ->paginate(10);
            //если полное имя 
            //$characters = Character::whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$request->name])
                          //->paginate(10); 
        } else {
            $characters = Character::with('quotes')
                          ->paginate(10);

            //in task - only episode_id, character_id
            $characters->transform(function ($characters) {
                $characters->quotes->transform(function ($quotes) {
                  unset($quotes->id);
                  unset($quotes->quote);                    
                  return $quotes;
                });
                    
                return $characters;
            });
  
        }       

        if (! $characters) {
            return responder()
            ->error()
            ->respond();
        }        
        
        return responder()
        ->success($characters)
        ->respond();                
    }
    
    /**
     * Display a random of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random()
    {       
        $character = Character::orderBy(\DB::raw('RAND()'))->take(1)->get();
        
        if (! $character) {
            return responder()
            ->error()
            ->respond();
        }
        
        return responder()
        ->success($character)
        ->respond();
    }
}
