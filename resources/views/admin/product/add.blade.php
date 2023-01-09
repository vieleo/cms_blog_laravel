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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- endvalidation --}}


    <h2>{{ trans('messages.create_product') }}</h2>
    <div class="form-group">
       <label for=""style="font-wight:300">{{ trans('messages.note') }}: </label> <label style="color: red">(*)</label><label for="">{{ trans('messages.note_message') }}</label>
    </div>

    <form action="/admin/add-product" method="post" style="width: 75%"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="Product Name">{{ trans('messages.name_product') }}</label> <label style="color: red">(*)</label>
            <input type="text" name="name" class="form-control"  placeholder="Product Name" >
            @error('name')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div></br>


        <div class="form-group">
            <label for="name">{{ trans('messages.category') }}</label> <label style="color: red">(*)</label>
              <select class="form-select" name="category_id" id="category_id" aria-label="Default select example">
                <option selected>{{ trans('messages.select_category') }}</option>
                    @foreach ($category as $categories)
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                    @endforeach
                </select>
          </div></br>

          <div class="form-group">
            <label for="Quantity">{{ trans('messages.quantity') }}</label> <label style="color: red">(*)</label>
            <input type="text" name="quantity" class="form-control"  placeholder="" >
            @error('quantity')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div></br>

          <div class="form-group">
            <label for="Price">{{ trans('messages.price_old') }}</label> <label style="color: red">(*)</label>
            <input type="text" name="price_old" class="form-control"  placeholder="" >
            @error('price_old')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div></br>

          <div class="form-group">
            <label for="Price">{{ trans('messages.price_new') }}</label> <label style="color: red">(*)</label>
            <input type="text" name="price_new" class="form-control"  placeholder="" >
            @error('price_new')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div></br>

          <div class="form-group">
            <label for="Product Name">{{ trans('messages.image') }}</label>
            <br>
            <input type="file" class="form-control" name="photos[]" multiple />
          </div></br>

          <div class="form-group">
            <label for="description">{{ trans('messages.description') }}</label> <label style="color: red">(*)</label>
            <textarea class="form-control" rows="5" name="description"  id="description"></textarea>
            @error('description')
                <span class="text-danger">{{$message}}</span>
            @enderror
          </div></br>

          <div class="form-group">
            <label for="name">{{ trans('messages.status') }}</label>
              <select class="form-select" name="status" id="status" aria-label="Default select example">
                  <option selected value="1">{{ trans('messages.display') }}</option>
                  <option value="0">{{ trans('messages.hide') }}</option>
              </select>
          </div></br>

        <button type="submit" class="btn btn-primary">{{ trans('messages.create') }}</button>
    </form>
        <script>
             CKEDITOR.replace( 'description' );
        </script>
@endsection
