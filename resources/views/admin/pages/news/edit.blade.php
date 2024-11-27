@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <h4>Chỉnh sửa tin tức</h4>

        <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
            </div>

            <div class="form-group">
                <label for="content">Nội dung</label>
                <textarea name="content" class="form-control" required>{{ old('content', $news->content) }}</textarea>
            </div>

            <div class="form-group">
                <label for="author">Tác giả</label>
                <input type="text" name="author" class="form-control" value="{{ old('author', $news->author) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh</label>
                <input type="file" name="image" class="form-control">
                @if ($news->image)
                    <p>Hình ảnh hiện tại:</p>
                    <img src="{{ asset('storage/' . $news->image) }}" width="100" alt="image">
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-2">Cập nhật tin tức</button>
        </form>
    </div>
</div>
@endsection
