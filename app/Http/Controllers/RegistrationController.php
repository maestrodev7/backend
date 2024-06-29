<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            $registration = Registration::findOrFail($id);
            return response()->json($registration, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Registration not found',
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $registration = Registration::findOrFail($id);
            $registration->user_id = $request->input('user_id', $registration->user_id);
            $registration->training_id = $request->input('training_id', $registration->training_id);
            $registration->status = $request->input('status', $registration->status);
            $registration->save();

            return response()->json([
                'message' => 'Registration updated successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Registration not found',
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'error' => $e->errors()
            ], 400);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $registration = Registration::findOrFail($id);
            $registration->delete();

            return response()->json([
                'message' => 'Registration deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Registration not found',
            ], 404);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Database error',
                'error' => $e->getMessage()
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
