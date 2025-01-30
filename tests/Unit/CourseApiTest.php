<?php

namespace Tests\Unit;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseApiTest extends TestCase
{
    use RefreshDatabase; 
    
    public function test_store() { 
        
        // Create an admin user
        $admin = User::factory()->admin()->create();
        
         $data = [ 
            'title' => 'Test Course',
            'price' => 200.99, 
            'start_date' => '2025-01-01', 
            'end_date' => '2025-06-30', 
            'instructor_name' => 'John Doe',
            ]; 
            
            // Act as admin and send the post request
             $response = $this->actingAs($admin)->postJson('/api/courses', $data);

             // Assert response
             $response->assertStatus(201)
              ->assertJson(['title' => 'Test Course']);

        } 
            
            
        public function test_update() {
            
            // Create a course and an admin user
             $course = Course::factory()->create();
             $admin = User::factory()->admin()->create();
             
             $data = [ 
                'title' => 'Updated Course Title',
                'price' => 299.99, 
                'start_date' => '2025-02-01', 
                'end_date' => '2025-11-30',
                'instructor_name' => 'Jane Doe', 
            ]; 
            
            // Act as admin and send the put request
             $response = $this->actingAs($admin)->putJson("/api/courses/{$course->id}", $data);
             
             // Assert response
              $response->assertStatus(200)
               ->assertJsonFragment(['title' => 'Updated Course Title']); 
            
            } 
            
        public function test_show() { 
            // Create a course
             $course = Course::factory()->create();
              
             // Send the get request
            $response = $this->getJson("/api/courses/{$course->id}");
            
            // Assert response
             $response->assertStatus(200)
              ->assertJsonFragment(['title' => $course->title]);
         }
            
            
         public function test_destroy() {
            // Create a course and an admin user
             $course = Course::factory()->create();
              $admin = User::factory()->admin()->create();
              
              // Send delete request
               $response = $this->actingAs($admin)->deleteJson("/api/courses/{$course->id}"); 
               
               // Assert response 
               $response->assertStatus(200)
                ->assertJson(['message' => 'Course deleted successfully']); 
            } 
            
        
}
