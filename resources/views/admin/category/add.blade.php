@extends('admin.layouts.layout')

@section('content')
<?php //Hiển thị thông báo thành công?>

@if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif

<?php //Hiển thị thông báo lỗi?>
@if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif



{{-- validation --}}
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
{{-- end_validation --}}


    <h2>{{ trans('messages.create_category') }}</h2>
    <form action="/admin/add-category" method="post">
        @csrf
        <div class="form-group">
          <label for="name">
             {{ trans('messages.name_category') }}
          </label>
          <input type="text" class="form-control" name="name" id="name">
          @error('name')
            <span class="text-danger">
                {{$message}}
            </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="description">
            {{ trans('messages.description') }}
        </label>
          <textarea class="form-control" rows="5" name="description" id="description"></textarea>
          @error('description')
            <span class="text-danger">{{$message}}</span>
          @enderror
        </div></br>
        <button type="submit" class="btn btn-primary">{{ trans('messages.create') }}</button>
    </form>
@endsection
