<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ValidateInventory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(),$this->rules($request));

        if ($validator->fails()) {
     
            return response()->json($validator->errors(), 422);
        }
        return $next($request);
    }

    public function rules($request)
	{
        $mrules=[];
        if(Str::contains($request->fullUrl(), 'add')){
            $mrules=	 [
                'name' => 'required|max:255',
                'quantity' => 'required|Integer',
                'price' => 'required|numeric',
                'category' => 'required|max:255',
    
            ];
        }
        
        else if(Str::contains($request->fullUrl(), 'update')){
            $mrules=	 [
                'id' => 'required|Integer',
                'name' => 'max:255',
                'quantity' => 'Integer',
                'price' => 'numeric',
                'category' => 'max:255',
    
            ];  
        }
        else if(Str::contains($request->fullUrl(), 'delete')){
            $mrules=	 [
                'id' => 'required|Integer',
            ];  
        }
	   
       return $mrules;
	}
    protected function response($request, $errors)
    {
        return response()->json($errors, 422);
    }
}
