<?php

namespace App\Http\Controllers;

use App\Models\Robotmodel;
use Illuminate\Http\Request;

class RobotmodelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $robotmodels = Robotmodel::all();
        return response()->json([
            'robotmodels' => $robotmodels,
            'message' => 'robotmodels',
            'code' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Robotmodel::create($request->all());

        return response()->json([
            'message' => 'Robotmodel Created successfully.',
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Robotmodel  $robotmodel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Robotmodel::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Robotmodel  $robotmodel
     * @return \Illuminate\Http\Response
     */
    public function edit(Robotmodel $robotmodel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Robotmodel  $robotmodel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $robotmodel = Robotmodel::find($id);
        $robotmodel->update($request->all());
        
        return response()->json([
            'message' => 'Robotmodel updated successfully.',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Robotmodel  $robotmodel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $robotmodel = Robotmodel::find($id);
        if($robotmodel){
            $robotmodel->delete();
            return response()->json([
                'message' => 'Robotmodel  deleted successfully.',
                'code' => 200
            ]);
        }      
        else{
            return response()->json([
                'message' => 'Robotmodel  not found',
            ]);
        }  
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Robotmodel::where('name', 'like', '%'.$name.'%')->get();
    }
}
