<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // API endpoint for fake books 
         $response = Http::get('https://freetestapi.com/api/v1/books');
         
         if ($response->successful()) {
             $books = $response->json();
             
             foreach ($books as $book) { 
                Book::updateOrCreate( 
                [ 'title' => $book['title'],
                 'author' => $book['author'],
                 'publication_year' => $book['publication_year'],
                 'genre' => $book['genre'],
                 'cover_image' => $book['cover_image'],
                 'description' => $book['description'] ?? null, 
                   ] ); 
                } 
                $this->info('Books fetched and updated successfully.'); 
            } 
            
            else { $this->error('Failed to fetch books.'); 
            
            } 
        
    }
}
