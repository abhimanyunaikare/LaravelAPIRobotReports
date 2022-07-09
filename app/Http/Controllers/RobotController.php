<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Robot;
use App\Models\User;
use Illuminate\Http\Request;

class RobotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Auth::user()->role == 'admin')
        // {
        //     return Robot::all();
        // }
        // else{
        //     return Robot::join('users', 'robots.user_id', '=', 'users.id')
        //                 ->where('robots.user_id', Auth::user()->id)
        //                 ->get();
        // }
        $robots = Robot::all();
        return response()->json([
            'robots' => $robots,
            'message' => 'robots',
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
     * Only Admin has authority to create new robot.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'description' => 'required',
        //     'user_id' => 'required',
        //     'city_id' => 'required',
        //     'robotmodel_id' => 'required'
        // ]);

        // if(Auth::user()->role == 'admin')
        //     return Robot::create($request->all());
        // else
        //     return "You don't have the priviledges.";
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'city_id' => 'required',
            'robotmodel_id' => 'required'
        ]);

        Robot::create($request->all());

        return response()->json([
            'message' => 'Robot Created successfully.',
            'code' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(Auth::user()->role == 'admin')
        // {
        //     return Robot::find($id);            
        // }
        // else
        // {
        //     return Robot::join('users', 'robots.user_id', '=', 'users.id')
        //                 ->where('users.id', Auth::user()->id)
        //                 ->where('robots.id', $id)
        //                 ->get();
        // }
        return Robot::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function edit(Robot $robot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'description' => 'required',
        //     'status' => 'required',
        //     'user_id' => 'required',
        //     'city_id' => 'required',
        //     'robotmodel_id' => 'required'
        // ]);


        // if(Auth::user()->role == 'admin')
        // {
        //     $robot = Robot::find($id);
        //     $robot->update($request->all());
        //     return $robot;
        // }    
        // else
        //     return "You don't have the priviledges.";
            
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $robot = Robot::find($id);
        $robot->update($request->all());
        
        return response()->json([
            'message' => 'Robot updated successfully.',
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        if(Auth::user()->role == 'admin')
        {
            return Robot::destroy($id);            
        }    
        else
            return "You don't have the priviledges.";            
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        if(Auth::user()->role == 'admin')
        {
            return Robot::where('name', 'like', '%'.$name.'%')->get();
        }
        else
        {
            return Robot::join('users', 'robots.user_id', '=', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->where('robots.name', 'like', '%'.$name.'%')
                        ->get();
        }
    }

    /**
     * Display the count of Robots.
     *
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function countofrobots($user)
    {
        if(Auth::user()->role == 'admin')
        {
            /* return Robot::where('user_id', '=', $user)->count(); */
            return Robot::all()->count();
        }
        else
        {
            return Robot::join('users', 'robots.user_id', '=', 'users.id')
                        ->where('users.id', Auth::user()->id)
                        ->get()
                        ->count();
        }
    }

    /**
     * Display the info of all the Robots.
     *
     * @param  \App\Models\Robot  $robot
     * @return \Illuminate\Http\Response
     */
    public function infoofallrobots($user)
    {
        if(Auth::user()->role == 'admin')
        {
            return Robot::join('users', 'robots.user_id', '=', 'users.id')
                        ->join('inputsensors', 'inputsensors.robot_id', '=', 'robots.id')
                        ->get(['inputsensors.*','robots.*']);            
        }
        else
        {
            return Robot::join('users', 'robots.user_id', '=', 'users.id')
                        ->join('inputsensors', 'inputsensors.robot_id', '=', 'robots.id')
                        ->where('users.id','=',$user)
                        ->get(['inputsensors.*','robots.*']);            
        }

    }

}
