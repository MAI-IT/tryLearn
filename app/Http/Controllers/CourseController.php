<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request) { 

        //validate request data
        $request->validate([
             'title' => 'required|string|max:250',
             'price' => 'required|decimal',
             'start_date' => 'required|date',
             'end_date' => 'required|date',
             'instructor_name' => 'required|string|max:250',
        ]);

        //try to create a course
        try {
            $course = Course::create($request->all());
            return response()->json($course, 201); //return the created course

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to create a course: ' .$e->getMessage()], 500);
        }
             
        
     } 
     
     public function update(Request $request, $id) {
        //validate request data
         $request->validate([ 
            'title' => 'required|string|max:250',
            'price' => 'required|decimal', 
            'start_date' => 'required|date',
            'end_date' => 'required|date', 
            'instructor_name' => 'required|string|max:250', 
         ]); 
         
         //try to update course
         try {
            $course = Course::findOrFail($id);
            $course->update($request->all());
            return response()->json($course); //return the updated course
         } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to update course: ' .$e->getMessage()], 500);
        }

    } 
         
         
    public function show($id) { 
        //try to retrieve a course
        try {
            $course = Course::findOrFail($id);
            return response()->json($course);
        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'course not found: ' .$e->getMessage()], 404);
        }

     } 
     
     public function index(Request $request) {
        //try to list and filtering courses
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
        
        
        public function destroy($id) { 
            //try to find and delete the course
            try{
                $course = Course::findOrFail($id);
                $course->delete(); 
                return response()->json(['message' => 'Course deleted successfully']);

            } catch(\Exception $e) {
                //handle errors
                return response()->json(['error'=>'failed to delete course: ' .$e->getMessage()], 500);
            }
        
        }
}
