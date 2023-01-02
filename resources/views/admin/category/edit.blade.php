@extends('admin.layouts.layout')

@section('content')
    <h2>Update Category</h2>
    <form action="/admin/update-category/{{ $categories->id}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" value="{{ $categories->name }}">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description">Description:</label>
          <textarea class="form-control" rows="5" name="description">{{ $categories->description }}</textarea>
          @error('description')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div></br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
