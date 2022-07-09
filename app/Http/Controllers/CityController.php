<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return response()->json([
            'cities' => $cities,
            'message' => 'cities',
            'code' => 200
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexstatescountries()
    {

        $cities = City::select('cities.id', DB::raw('CONCAT(countries.name, " - ", states.name, " - ", cities.name) as name'), 'cities.state_id')
        ->join('states', 'states.id', '=', 'cities.state_id')
        ->join('countries', 'states.country_id', '=', 'countries.id')
        ->get();
        
        return response()->json([
            'cities' => $cities,
            'message' => 'cities',
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
            'state_id' => 'required',
        ]);

        City::create($request->all());

        return response()->json([
            'message' => 'City Created successfully.',
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return City::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'state_id' => 'required',
        ]);
        
        $city = City::find($id);
        $city->update($request->all());
        
        return response()->json([
            'message' => 'City updated successfully.',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        if($city){
            $city->delete();
            return response()->json([
                'message' => 'City  deleted successfully.',
                'code' => 200
            ]);
        }      
        else{
            return response()->json([
                'message' => 'City  not found',
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
        return City::where('name', 'like', '%'.$name.'%')->get();
    }
}
