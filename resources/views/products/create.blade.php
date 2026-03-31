@extends('layouts.app')

@section('content')

<h3>Thêm sản phẩm</h3>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" class="form-control">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input type="number" name="price" class="form-control">
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Số lượng</label>
        <input type="number" name="quantity" class="form-control">
        @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <input type="text" name="category" class="form-control">
        @error('category') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">Lưu</button>
</form>

@endsection