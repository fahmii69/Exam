<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $default_show_data = 10;

        $booksRating = Rate::selectRaw('avg(rate) as average_rating')
                        ->whereColumn('book_id', 'books.id')
                        ->getQuery();

        $query = Book::query()->take($default_show_data);
        $query->when($request->filter_data, function($query) use ($request) {
            return $query->take($request->filter_data);
        });

        $query->when($request->search, function($query) use ($request) {
            return $query->where('name', 'LIKE', '%' . $request->search . '%');
        });

        $query->select('books.*')->selectSub($booksRating, 'average_rating')->orderBy('average_rating', 'DESC');
        
        $books = $query->with('category', 'author', 'voter')->get();

        return view('home', [
            'books' => $books,
        ]);
    }

public function top10()
    {
        $authors = Author::with('voter')->get();
        $authors = $authors->sortByDesc(function($author) {
            return $author->voter->count();
        })->take(10);

        return view('top10', [
            'authors' => $authors,
        ]);
    }

    public function rate()
    {
        return view('rating', [
            'authors' => Author::get(),
        ]);
    }

    public function getBookByAuthor(Request $request)
    {
        $books = Book::where('author_id', $request->author_id)->get();
        if ($books->count() > 0) {
            $result = [
                'status' => 200,
                'data' => $books,
                'message' => 'fetch data successfully'
            ];
        } else {
            $result = [
                'status' => 500,
                'message' => 'data not found'
            ];
        }
        
        return response()->json($result, $result['status']);
    }

    public function input_rating(Request $request)
    {
        Rate::create([
            'rate' => $request->rate,
            'book_id' => $request->book_id,
            'author_id' => $request->author_id
        ]);

        return redirect()->route('home');
    }
}
