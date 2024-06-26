<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Trainings;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

use Illuminate\Support\Str;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Trainings::all();
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
            $training = new Trainings();
            $training->id = Str::uuid();
            $training->title = $request->input('title');
            $training->description = $request->input('description');
            $training->duration = $request->input('duration');
            $training->price = $request->input('price');
            $training->trainer_id = $request->input('trainer_id');
            $training->save();
            $response = [
                "message"=>"training saved successfully",
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
            $training = Trainings::findOrFail($id);
            return response()->json($training,200);
        }catch(ModelNotFoundException){
            return response()->json(
                [
                    "message"=>"Training not found",
                ],404);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'duration' => 'required|integer',
                'price' => 'required|numeric',
                'trainer_id' => 'required|uuid',
            ]);
           $training = Trainings::findOrFail($id);

           $training->title = $request->input('title');
            $training->description = $request->input('description');
            $training->duration = $request->input('duration');
            $training->price = $request->input('price');

           $training->save();
           $response = [
               "message"=>"Training updated successfully",
           ];
           return response()->json($response,201);
       }catch(ModelNotFoundException){
           return response()->json(
               [
                   "message"=>"Training not found",
               ],404);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $training = Trainings::findOrFail($id);
            $training->delete();
            $response = [
                "message"=>"Training deleted successfully",
            ];
            return response()->json($response,201);
        }catch(ModelNotFoundException){
            return response()->json(
                [
                    "message"=>"Training not found",
                ],404);
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
}
