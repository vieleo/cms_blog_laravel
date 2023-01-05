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
    <form action="/admin/add-product" method="post" style="width: 75%"  enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="Product Name">{{ trans('messages.name_product') }}</label>
            <input type="text" name="name" class="form-control"  placeholder="Product Name" >
        </div></br>

        <div class="form-group">
            <label for="name">{{ trans('messages.category') }}</label>
              <select class="form-select" name="category_id" id="category_id" aria-label="Default select example">
                <option selected>{{ trans('messages.select_category') }}</option>
                    @foreach ($category as $categories)
                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                    @endforeach
                </select>
          </div></br>

          <div class="form-group">
            <label for="Quantity">{{ trans('messages.quantity') }}</label>
            <input type="text" name="quantity" class="form-control"  placeholder="" >
          </div></br>

          <div class="form-group">
            <label for="Price">{{ trans('messages.price_old') }}</label>
            <input type="text" name="price_old" class="form-control"  placeholder="" >
          </div></br>

          <div class="form-group">
            <label for="Price">{{ trans('messages.price_new') }}</label>
            <input type="text" name="price_new" class="form-control"  placeholder="" >
          </div></br>

          <div class="form-group">
            <label for="Product Name">{{ trans('messages.image') }}</label>
            <br>
            <input type="file" class="form-control" name="photos[]" multiple />
          </div></br>

          <div class="form-group">
            <label for="description">{{ trans('messages.description') }}</label>
            <textarea class="form-control" rows="5" name="description" id="description"></textarea>
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
@endsection
