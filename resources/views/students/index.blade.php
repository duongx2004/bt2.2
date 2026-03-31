@extends('layouts.app')

@section('content')

<h3>Quản lý sinh viên</h3>

<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Thêm sinh viên</a>

<form method="GET" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Tìm theo tên"
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="">Mặc định</option>
            <option value="asc" {{ request('sort')=='asc'?'selected':'' }}>A-Z</option>
            <option value="desc" {{ request('sort')=='desc'?'selected':'' }}>Z-A</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-success">Lọc</button>
    </div>
</form>

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Tên</th>
        <th>Ngành</th>
        <th>Email</th>
        <th>Action</th>
    </tr>

    @foreach($students as $st)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $st->name }}</td>
        <td>{{ $st->major }}</td>
        <td>{{ $st->email }}</td>
        <td>
            <a href="{{ route('students.edit', $st) }}" class="btn btn-warning btn-sm">Sửa</a>

            <form action="{{ route('students.destroy', $st) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

{{ $students->links() }}

@endsection