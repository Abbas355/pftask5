<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function addInventory(Request $request){
        
        $inventory=Inventory::create($request->all());
        return response()->json(["message" => "Inventory added succefully","data"=>$inventory], 201);
    }
    public function readInventory($id=false){ 
        if ($id) {  
           if( !Inventory::where('id', $id)->exists()){
                return response()->json(["message" => "Inventory not found"
                ], 404);
           }
            $inventorys=Inventory::find($id);   
        }else{
            $inventorys=Inventory::all();
        }    
        return $inventorys;
    }
    public function updateInventory(Request $request){
        if( !Inventory::where('id', $request->input('id'))->exists()){
            return response()->json(["message" => "Inventory not found"
            ], 404);
        }
        $inventory=Inventory::find($request->input('id'));
        $inventory->update($request->all()); 
        return response()->json( ["message" => "Inventory updated succefully","data"=> $inventory
    ], 200);

    }
    public function delete(Request $request){
        if( !Inventory::where('id', $request->input('id'))->exists()){
            return response()->json(["message" => "Inventory not found"
           ], 404);
        }
        Inventory::destroy($request->input('id')); 
        return response()->json(["message" => "Inventory deleted succefully"]);
    }
    
}
