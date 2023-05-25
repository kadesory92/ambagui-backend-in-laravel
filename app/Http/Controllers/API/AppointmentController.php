<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments=Appointment::all();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validations=Validator::make($request->all(), [
            'date' => 'required',
            'hour' => 'required',
            'fullName' => 'required|string',
            'email' => 'required|string',
            'service' => 'required|string',
            'reason' => 'required|string',
        ]);

        if($validations->fails()){
            $errors=$validations->errors();

            return response()->json([
                'errors'=>$errors,
                'status'=>401
            ]);
        }

        if($validations->passes()){
            $appointment=Appointment::create([
                'date'=>$request->date,
                'hour'=>$request->hour,
                'fullName'=>$request->fullName,
                'email'=>$request->email,
                'service'=>$request->service,
                'reason'=>$request->reason,
            ]);

            return response()->json([
                'appointment'=>$appointment,
                'status'=> 200
            ]);

        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
