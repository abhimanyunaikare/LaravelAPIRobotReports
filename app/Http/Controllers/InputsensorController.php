<?php

namespace App\Http\Controllers;

use App\Models\Inputsensor;
use Illuminate\Http\Request;

class InputsensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inputsensor::all();
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
            'parameter_id' => 'required',
            'robot_id' => 'required',
            'value' => 'required'
        ]);

        return Inputsensor::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inputsensor  $inputsensor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Inputsensor::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inputsensor  $inputsensor
     * @return \Illuminate\Http\Response
     */
    public function edit(Inputsensor $inputsensor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inputsensor  $inputsensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'parameter_id' => 'required',
            'robot_id' => 'required',
            'value' => 'required'
        ]);
        
        $inputsensor = Inputsensor::find($id);
        $inputsensor->update($request->all());
        return $inputsensor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inputsensor  $inputsensor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Inputsensor::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Inputsensor::where('name', 'like', '%'.$name.'%')->get();
    }
}
