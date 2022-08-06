@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-md-4">
      <form action="{{ route('home') }}">
        <div class="form-group">
          <label for="filter_data">List shown:</label>
          <select name="filter_data" id="filter_data" class="form-control">
            @for ($i = 10; $i <= 100; $i+=10)
              <option value="{{ $i }}" {{ request('filter_data') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
          </select>
        </div>
  
        <div class="form-group">
          <label for="search">Search :</label>
          <input type="text" name="search" id="search" class="form-control" placeholder="Search" value="{{ request('search') ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">SUBMIT</button>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <table class="table table-bordered" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Book Name</th>
            <th>Category Name</th>
            <th>Author Name</th>
            <th>Average Rating</th>
            <th>Voter</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($books as $book)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $book->name }}</td>
              <td>{{ $book->category->name }}</td>
              <td>{{ $book->author->name }}</td>
              <td>{{ $book->average_rating }}</td>
              <td>{{ $book->voter->count() }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection