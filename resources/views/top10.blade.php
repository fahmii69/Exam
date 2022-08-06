@extends('layouts.main')

@section('content')

<h1>Top 10 Most Famous Author</h1>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Author Name</th>
      <th>Voter</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($authors as $author)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $author->name }}</td>
        <td>{{ $author->voter->count() }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
