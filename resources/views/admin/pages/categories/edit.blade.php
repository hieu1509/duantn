@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4>Chỉnh sửa danh mục</h4>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Cập nhật</button>
        </form>
    </div>
</div>
@endsection
