@extends('layouts.app')

@section('content')

<h3>Sửa sản phẩm</h3>

<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control" value="{{ $product->price }}">
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Số lượng</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
        @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <input type="text" name="category" class="form-control" value="{{ $product->category }}">
        @error('category') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Cập nhật</button>
</form>

@endsection