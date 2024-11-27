@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4 class="mb-4">Cập nhật danh mục con</h4>
        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" name="image" class="form-control">
                @if($subcategory->image)
                <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" width="100">
                @endif
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái</label>
                <select name="status" class="form-select" required>
                    <option value="1" {{ $subcategory->status ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ !$subcategory->status ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật danh mục con</button>
        </form>
    </div>
</div>
@endsection
