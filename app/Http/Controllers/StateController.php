<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::select('states.id', DB::raw('CONCAT(countries.name, " - ", states.name) as name'), 'states.country_id',  DB::raw('countries.name as cname'))
        ->join('countries', 'states.country_id', '=', 'countries.id')
        ->get();
        
        return response()->json([
            'states' => $states,
            'message' => 'states',
            'code' => 200
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexcountries()
    {

        $states = State::select('states.id', DB::raw('CONCAT(countries.name, " - ", states.name) as name'), 'states.country_id')
        ->join('countries', 'states.country_id', '=', 'countries.id')
        ->get();
        
        return response()->json([
            'states' => $states,
            'message' => 'states',
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
            'name' => 'required',
            'country_id' => 'required'
        ]);

        State::create($request->all());

        return response()->json([
            'message' => 'State Created successfully.',
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return State::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'country_id' => 'required'
        ]);

        $state = State::find($id);
        $state->update($request->all());
        
        return response()->json([
            'message' => 'State Updated successfully.',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::find($id);
        if($state){
            $state->delete();
            return response()->json([
                'message' => 'State  deleted successfully.',
                'code' => 200
            ]);
        }      
        else{
            return response()->json([
                'message' => 'State  not found',
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
        return State::where('name', 'like', '%'.$name.'%')->get();
    }
}
