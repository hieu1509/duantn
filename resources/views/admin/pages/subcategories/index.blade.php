@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4 class="mb-4">Danh sách danh mục con</h4>
        <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-3">Thêm danh mục con</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Trạng thái</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subcategories as $subcategory)
                <tr>
                    <td>{{ $subcategory->id }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" width="100">
                    </td>
                    <td>{{ $subcategory->status ? 'Hoạt động' : 'Không hoạt động' }}</td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>
                            <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary"><i class="ri-pencil-fill fs-16"></i></a>

                            <!-- Form xóa danh mục -->
                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"><i class="ri-delete-bin-5-fill fs-16"></i></button>
                            </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
