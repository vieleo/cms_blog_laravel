@extends('admin.layouts.layout')

@section('content')
    <h2>{{ trans('messages.update_category') }}</h2>
    <div class="form-group">
        <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
     </div>
    <form action="/admin/update-category/{{ $categories->id}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">{{ trans('messages.name_category') }}</label> <label style="color: red">(*)</label>
          <input type="text" class="form-control" name="name" value="{{ $categories->name }}">
          @error('name')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description">{{ trans('messages.description') }}</label> <label style="color: red">(*)</label>
          <textarea class="form-control" rows="5" id="description" name="description">{!! $categories->description !!}</textarea>
          @error('description')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div></br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.update') }}</button>
    </form>
    <script>
        CKEDITOR.replace( 'description' );
   </script>
@endsection
