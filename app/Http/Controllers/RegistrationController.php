<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $user = Registration::all();
            return response()->json($user,200);
        }catch (QueryException $e) {
            return response()->json([
                'message'=>'An error occured',
                'error'=> $e->getmessage()
            ],500);
        }catch (Exception $e) {
            return response()->json([
                'message'=>'An error occured',
                'error'=> $e->getmessage()
            ],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|uuid',
                'training_id' => 'required|uuid',
                'status' => 'required|string',
                'advance' => 'required',
                'remaind' => 'required',
            ]);
            $training = new Registration();
            $training->id = Str::uuid();
            $training->user_id = $request->input('user_id');
            $training->training_id = $request->input('training_id');
            $training->status = $request->input('status');
            $training->advance = $request->input('advance');
            $training->remaind = $request->input('remaind');
            $training->save();
            $response = [
                "message"=>"registration saved successfully",
                "training_id"=>$training->id,
            ];
            return response()->json($response,201);
        } catch (ValidationException $e) {
            $response = [
                "message"=>"Validation error",
                "error"=>$e->errors(),
            ];
            return response()->json($response,201);
        }catch (QueryException $e) {
            return response()->json([
                'message'=>'Database  error',
                'error'=> $e->getmessage()
            ],500);
        }catch (Exception $e) {
            return response()->json([
                'message'=>'An error occured',
                'error'=> $e->getmessage()
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
