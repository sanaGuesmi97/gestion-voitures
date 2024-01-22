<?php

namespace App\Http\Controllers\Marque;

use App\Http\Controllers\Controller;
use App\Http\Requests\Marque\StoreMarqueRequest;
use App\Http\Requests\Marque\UpdateMarqueRequest;
use App\Http\Resources\Marque\MarqueResource;
use Illuminate\Http\Request;
use App\Models\Marque;

class MarqueController extends Controller
{

    public function index()
    {  
        $marque = Marque::all();
        $marque = MarqueResource::collection($marque);
        return $marque;
    }

    public function store(StoreMarqueRequest $request)
    {
        $marque = new Marque;
        $marque->title = $request->title;
        $marque->save();
    }

    public function show($id)
    {
        try {
            $marque = Marque::findOrFail($id);
            return $marque;
        } catch (\Exception $e) {
            return $e->getMessage();
        };
    }




    public function update(UpdateMarqueRequest $request, $id)
    {
        $marque = Marque::find($id);
        $marque->update($request->all());
        return $marque;

    }


    public function delete($id)
    {
        $marque=Marque::find($id);
        $marque->delete();
        return'deleted';
    }
    public function restore($id)
    {
        $marque=Marque::withTrashed()->find($id);
        $marque->restore();
        return'restored one';
    }
}
