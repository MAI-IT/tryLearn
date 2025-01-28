<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request) { 
        try{
            //validate request data
            $request->validate([ 
                'student_id' => 'required|exists:students,id',
                'course_id' => 'required|exists:courses,id',
            ]);
            
            //create a registration
            $course = Course::find($request->course_id);
            if ($course->end_date < now()) {
            return response()->json(['message' => 'course has already ended'], 400);
            
            } 
            
            $existingRegistration = Registration::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)->exists();
            if ($existingRegistration) { 
                return response()->json(['message' => 'student is already registered'], 400);
            } 
        
            $registration = Registration::create($request->all());
            
            return response()->json($registration, 201);

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to create a registration: ' .$e->getMessage()], 500);
        }
        
    
    } 

    public function update(Request $request, $id) { 
        try{
            //validate request data
            $request->validate([ 
                'student_id' => 'required|exists:students,id',
                'course_id' => 'required|exists:courses,id',
                ]);
            
            //update a registration
            $registration = Registration::findOrFail($id);
            $registration->update($request->all());
            return response()->json($registration); 

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to update registration: ' .$e->getMessage()], 500);
        } 
    }

    public function show($id) {
        //find a regisrtation by id
        try{
            $registration = Registration::findOrFail($id);
            return response()->json($registration); 
        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'registration not found: ' .$e->getMessage()], 404);
        }
        
    }

    public function index(Request $request) { 
        //list all registrations
        try{
            $registrations = Registration::with(['course', 'student']) 
            ->when($request->course_id, function ($query) use ($request) {
                return $query->where('course_id', $request->course_id);
                }) 
            ->when($request->student_id, function ($query) use ($request) {
                return $query->where('student_id', $request->student_id);
                }) 
            ->when($request->instructor_name, function ($query) use ($request) {
                return $query->whereHas('course', function ($query) use ($request) {
                        $query->where('instructor_name', 'like', '%'.$request->instructor_name.'%');
                    });
                }) 
            ->paginate(10);
                         
             return response()->json($registrations);

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to fetch registration: ' .$e->getMessage()], 500);
        }
                        
    } 
                        
   
}
