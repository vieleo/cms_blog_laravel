@extends('admin.layouts.layout')

@section('content')
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
    <div class="form-group">
    <h2>List Product</h2>
    <a class="btn btn-primary" href="/admin/add-product">ADD Product</a>
    </div>
    <table class="table table-bordered" >
        <tr style="text-align: center;">
            <th>S.No</th>
            <th>Name</th>
            <th>Cateogry</th>
            <th>Price Old (VNĐ)</th>
            <th>Price New (VNĐ)</th>
            <th>Description</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($product as $items)
        <tr>
            <td>{{ $items->id }}</td>
            <td>{{ $items->name }}</td>
            <td>{{ $items->categories->name }}</td>
            <td>{{ number_format($items->price_old,0,'.','.') }}</td>
            <td>{{ number_format($items->price_new,0,'.','.') }}</td>
            <td>{{ $items->description }}</td>
            <td>
                {{ json_encode($items->images) }}
                {{-- <img src="{{asset('tmp/uploads/'.$items->images->id)}}" class="card-img-top" alt="..."> --}}
            </td>
            <td  style="text-align: center;">
                <a class="btn btn-primary" href="/admin/edit-product/{{ $items->id}}">Edit</a>
                <a class="btn btn-danger show_confirm" href="/admin/delete-product/{{ $items->id}}" onclick="return confirm('You Sure Want Delete?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
