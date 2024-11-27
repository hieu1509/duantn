@extends('admin.layout')

@section('content')
<div class="page-content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    @endif

    <div class="container mb-15">
        <h1>Thêm storage</h1>
        <form class="mt-3" action="{{route('admins.storages.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Tên:</label>
                <input type="text" class="form-control" name="name" placeholder="Tên storage">
            </div>
            <div class="mt-3">
                <button class="btn btn-success" type="submit">Gửi</button>
                <a class="btn btn-light" href="{{route('admins.storages.index')}}">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection