@extends('layouts.main')

@section('content')
  <h1>Input Rating</h1>
  <div class="row">
    <div class="col-md-4">
      <form action="{{ route('rate') }}" method="POST">
        @csrf
      
        <div class="form-group">
          <label for="author_id">Book Author :</label>
          <select name="author_id" id="author_id" class="form-control">
            <option>Pilih author</option>
            @foreach ($authors as $author)
              <option 
                value="{{ $author->id }}" 
                data-url={{ route('getBookByAuthor', $author->id) }}
              >{{ $author->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="book_id">Book Name :</label>
          <select name="book_id" id="book_id" class="form-control">

          </select>
        </div>

        <div class="form-group">
          <label for="rate">Rating :</label>
          <select name="rate" id="rate" class="form-control">
            <option>Pilih rating</option>
            @for ($i=1; $i<=10; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      $(document).on('change', '#author_id', function(e) {
        const author_id = e.target.value;
        const url = $(this).find(':selected').data('url')

        $.ajax({
          url: url,
          success: function(res) {
            let options = "";
            res.data.map(book => {
              options += `<option value="${book.id}">${book.name}</option>`;
            });

            $("#book_id").empty().append(options);
          },
          error: function(res) {
            console.log(res.responseJSON.message);
          }
        })
        
      });
    });
  </script>
@endpush