<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request) {

        $this->authorize('create', Comment::class);

        try{
            //validate request data
            $request->validate([ 
                'comment' => 'required|string|max:250',
                'course_id' => 'required|exists:courses,id',
                'student_id' => 'required|exists:students,id',
            ]);

            //create a comment
            $comment = Comment::create($request->all());
            return response()->json($comment, 201); //return the created comment

        } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to create a comment: ' .$e->getMessage()], 500);
        }
        
     } 
     
     public function update(Request $request, $id) {

        $this->authorize('update', Comment::class);

        try{
            //validate request data
            $request->validate([
             'comment' => 'required|string|max:250', 
            ]);

            //update a comment
            $comment = Comment::findOrFail($id);
            $comment->update($request->all());
            return response()->json($comment); 

         } catch(\Exception $e) {
            //handle errors
            return response()->json(['error'=>'failed to update comment: ' .$e->getMessage()], 500);
        }
        
        } 
        
        public function index($courseId) { 
            //list of all comments on a specific course
            try{
                $comments = Comment::where('course_id', $courseId)->paginate(10);
                return response()->json($comments); 

            } catch(\Exception $e) {
                //handle errors
                return response()->json(['error'=>'comment not found: ' .$e->getMessage()], 404);
            }
        
        } 
        
        public function destroy($id) {
             //find comment by id and delete it
             try{
                $comment = Comment::findOrFail($id);
                $comment->delete();
                return response()->json(['message' => 'Comment deleted successfully']);

             } catch(\Exception $e) {
                //handle errors
                return response()->json(['error'=>'failed to delete comment: ' .$e->getMessage()], 500);
            }
            
            }
}
