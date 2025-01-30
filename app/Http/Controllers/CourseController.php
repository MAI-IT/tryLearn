<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request) { 
        try {
            //validate request data
            $request->validate([
                'title' => 'required|string|max:250',
                'price' => 'required|decimal:1,2',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'instructor_name' => 'required|string|max:250',
            ]);

            //create a course
            $course = Course::create($request->all());
            return response()->json($course, 201); //return the created course

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to create a course: ' .$e->getMessage()], 500);
        }
             
        
     } 
     
     public function update(Request $request, $id) {
        $course = Course::findOrFail($id);
        $this->authorize('update', $course);

        try {
            //validate request data
            $request->validate([ 
                'title' => 'required|string|max:250',
                'price' => 'required|decimal:1,2', 
                'start_date' => 'required|date',
                'end_date' => 'required|date', 
                'instructor_name' => 'required|string|max:250', 
            ]); 
            
            //update a course
            $course->update($request->all());
            return response()->json($course); //return the updated course
            
         } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to update course: ' .$e->getMessage()], 500);
        }

    } 
         
         
    public function show($id) { 
        //find a course by id
        try {
            $course = Course::findOrFail($id);
            return response()->json($course);

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'course not found: ' .$e->getMessage()], 404);
        }

     } 
     
     public function index(Request $request) {
        if (!auth()->check()) { return response()->json(['message' => 'User not authenticated'], 401); 
        } 
        
        return response()->json(auth()->user());

        //list and filtering courses
         try{
            $courses = Course::when($request->title, function ($query) use ($request) { 
                return $query->where('title', 'like', '%'.$request->title.'%'); 
            })
          ->when($request->start_date, function ($query) use ($request) {
             return $query->whereDate('start_date', $request->start_date); 
            }) 
          ->when($request->instructor_name, function ($query) use ($request) {
             return $query->where('instructor_name', 'like', '%'.$request->instructor_name.'%'); 
            }) 
          ->paginate(10); 
          
           return response()->json($courses); 
         } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to fetch courses: ' .$e->getMessage()], 500);
        }
        
        } 
        
        
        public function destroy(Request $request, $id) { 
            $course = Course::findOrFail($id);
            $this->authorize('delete', $course);

            //find a course by id and delete it
            try{
                $course->delete(); 
                return response()->json(['message' => 'Course deleted successfully']);

            } catch(\Exception $e) {
                //handle errors
                return response()->json(['error'=>'failed to delete course: ' .$e->getMessage()], 500);
            }
        
        }
}
