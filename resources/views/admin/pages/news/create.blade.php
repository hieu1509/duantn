@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4>Thêm tin tức mới</h4>

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="author">Tác giả</label>
                <input type="text" name="author" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-2">Thêm tin tức</button>
        </form>
    </div>
</div>
@endsection
