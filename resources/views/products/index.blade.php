@extends('layouts.app')

@section('content')

<h3>Quản lý sản phẩm</h3>

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Thêm sản phẩm</a>

<form method="GET" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Tìm theo tên"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-2">
        <button class="btn btn-success">Tìm</button>
    </div>
</form>

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Danh mục</th>
        <th>Trạng thái</th>
        <th>Action</th>
    </tr>

    @foreach($products as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->name }}</td>
        <td>{{ number_format($p->price) }}</td>
        <td>{{ $p->quantity }}</td>
        <td>{{ $p->category }}</td>

        <td>
            @if($p->quantity == 0)
                <span class="badge bg-danger">Hết hàng</span>
            @elseif($p->quantity < 5)
                <span class="badge bg-warning">Sắp hết</span>
            @else
                <span class="badge bg-success">Còn hàng</span>
            @endif
        </td>

        <td>
            <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">Sửa</a>

            <form action="{{ route('products.destroy', $p) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

{{ $products->links() }}

@endsection