<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function store(Request $request) { 
        try{
            //validate request data
            $request->validate([
                'name' => 'required|string|max:250',
                'price' => 'required|decimal:1,2',
                'start_date' => 'required|date',
                'end_date' => 'required|date', 
                'instructor_name' => 'required|string|max:250',
                ]);

            //create a student   
            $student = Student::create($request->all());
             return response()->json($student, 201); //return the created student

        }  catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to create a student: ' .$e->getMessage()], 500);
        }
              
            
        } 
            
    public function update(Request $request, $id) {
        try{
            //validate request data 
            $request->validate([ 
                'name' => 'required|string|max:250',
                'price' => 'required|decimal:1,2',
                'start_date' => 'required|date',
                'end_date' => 'required|date', 
                'instructor_name' => 'required|string|max:250',
                ]);
            
            //update a student
            $student = Student::findOrFail($id);            
            $student->update($request->all());
            return response()->json($student); //return the updated student

         } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to update student: ' .$e->getMessage()], 500);
        }

                    
     } 
                    
     public function show($id) { 
        //find a student by id
        try{
            $student = Student::findOrFail($id);
            return response()->json($student); 

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'student not found: ' .$e->getMessage()], 404);
        }
     }

     public function destroy(Request $request, $id) { 
       $student = Student::findOrFail($id);
       $this->authorize('delete', $student);

       try{
           $student->delete(); 
           return response()->json(['message' => 'Student deleted successfully']);

       } catch(\Exception $e) {
           //handle errors
           return response()->json(['error'=>'failed to delete student: ' .$e->getMessage()], 500);
       }
   
   }

}
