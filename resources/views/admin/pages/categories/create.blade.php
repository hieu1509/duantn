@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4>Thêm danh mục mới</h4>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-2">Thêm danh mục</button>
        </form>
    </div>
</div>
@endsection
