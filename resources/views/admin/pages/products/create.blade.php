@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Thêm sản phẩm</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                                <li class="breadcrumb-item active">Thêm sản phẩm</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- end page title -->

            <form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate
                action="{{ route('admins.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Tên sản phẩm</label>
                                    <input name="name" id="name" type="text" class="form-control"
                                        id="product-title-input" value="{{ old('name') }}" placeholder="Nhập tên sản phẩm" required>
                                    <div class="invalid-feedback">Nhập tên sản phẩm.</div>
                                </div>
                                <div>
                                    <label>Mô tả</label>

                                    <textarea name="content" id="ckeditor-classic">{{ old('content') }}
                                </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thư viện ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-1">Ảnh sản phẩm</h5>
                                    <p class="text-muted">Thêm ảnh sản phẩm chính.</p>
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="position-absolute top-100 start-100 translate-middle">
                                                <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Select Image">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input name="image" class="form-control d-none" value=""
                                                    id="product-image-input" type="file"
                                                    accept="image/png, image/gif, image/jpeg">
                                            </div>
                                            <div class="avatar-lg">
                                                <div class="avatar-title bg-light rounded">
                                                    <img src="" id="product-img" class="avatar-md h-auto"
                                                        style="display: none;" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    document.getElementById('product-image-input').addEventListener('change', function(event) {
                                        const file = event.target.files[0]; // Lấy file đầu tiên
                                        if (file) {
                                            const reader = new FileReader(); // Tạo FileReader để đọc file
                                            reader.onload = function(e) {
                                                const imgElement = document.getElementById('product-img');
                                                imgElement.src = e.target.result; // Cập nhật src của ảnh
                                                imgElement.style.display = 'block'; // Hiển thị ảnh
                                            };
                                            reader.readAsDataURL(file); // Đọc file dưới dạng URL
                                        }
                                    });
                                </script>
                                <div>
                                    <h5 class="fs-14 mb-1">Thư viện ảnh</h5>
                                    <p class="text-muted">Thêm thư viện ảnh sản phẩm.</p>

                                    <!-- Thêm nhiều hình ảnh sản phẩm -->
                                    <label for="images">Hình ảnh sản phẩm:</label>
                                    <input type="file" name="images[]" id="images" multiple>

                                    {{-- <div class="dropzone">
                                        <div class="fallback">
                                            <input name="images[]" id="images" type="file" multiple="multiple"
                                                accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                            </div>

                                            <h5>Chọn hoặc ném file để tải ảnh lên.</h5>
                                        </div>
                                    </div> --}}

                                    {{-- <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        <li class="mt-2" id="dropzone-preview-list">
                                            <!-- This is used as the file preview template -->
                                            <div class="border rounded">
                                                <div class="d-flex p-2">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded">
                                                            <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                                src="#" alt="Product-Image" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="pt-1">
                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                            <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                            <strong class="error text-danger" data-dz-errormessage></strong>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-3">
                                                        <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul> --}}
                                    <!-- end dropzon-preview -->
                                </div>
                            </div>

                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Trạng thái</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        <label for="choices-publish-status-input" class="form-label">Thông tin</label>

                                        <div class="col-lg-6">
                                            <div class="form-check form-switch form-switch-md" dir="ltr">
                                                <input type="hidden" name="is_sale" value="0">
                                                <input id="is_sale" checked name="is_sale" value="1" type="checkbox"
                                                    class="form-check-input" id="customSwitchsizemd">
                                                <label class="form-check-label" for="customSwitchsizemd">Sản phẩm
                                                    sale</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-check form-switch form-switch-md" dir="ltr">
                                                <input type="hidden" name="is_hot" value="0">
                                                <input id="is_hot" checked name="is_hot" value="1" type="checkbox"
                                                    class="form-check-input" id="customSwitchsizemd">
                                                <label class="form-check-label" for="customSwitchsizemd">Sản phẩm
                                                    Hot</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Trạng thái</label>

                                    <select id="is_show_home" name="is_show_home" class="form-select"
                                        id="choices-publish-status-input" data-choices data-choices-search-false>
                                        <option value="1" selected>Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Danh mục</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2"> <a href="#"
                                        class="float-end text-decoration-underline">Thêm mới
                                    </a>Chọn danh mục sp</p>
                                <select name="sub_category_id" id="subcategory_id" class="form-select"
                                    id="choices-category-input" name="choices-category-input" data-choices
                                    data-choices-search-false>
                                    @foreach ($sub_category as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thông số kỹ thuật</h5>
                            </div>
                            <div class="card-body">
                                <label class="text-muted mb-2">Thông số kỹ thuật sản phẩm</label>
                                <textarea name="description" id="description" class="form-control" placeholder="" rows="12">{{ old('description') }}</textarea>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Biến thể</h5>
                            </div>
                            <div class="card-body">
                                <div id="variants-container">
                                    <div class="variant-row row">
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="chip_id">Chip</label>
                                                <select name="chip_id[]" class="form-select mb-3">
                                                    @foreach ($chips as $key => $item)
                                                        <option value="{{ $key }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="ram_id">Ram</label>
                                                <select name="ram_id[]" class="form-select mb-3">
                                                    @foreach ($rams as $key => $item)
                                                        <option value="{{ $key }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="storage_id">SSD</label>
                                                <select name="storage_id[]" class="form-select mb-3">
                                                    @foreach ($storages as $key => $item)
                                                        <option value="{{ $key }}">{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="listed_price">Giá</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="product-price-addon">$</span>
                                                    <input name="listed_price[]" value="{{ old('listed_price[]') }}" type="number" class="form-control"
                                                        placeholder="Giá" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="sale_price">Giá khuyến mãi</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">%</span>
                                                    <input name="sale_price[]" value="{{ old('sale_price[]') }}" type="number" class="form-control"
                                                        placeholder="Khuyến mãi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label class="form-label" for="quantity">Số lượng</label>
                                                <input name="quantity[]" value="{{ old('quantity[]') }}" type="number" class="form-control"
                                                    placeholder="Số lượng">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-danger remove-variant">Xóa</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-variant" class="btn btn-primary">Thêm biến thể
                                    mới</button>
                                <script>
                                    document.getElementById('add-variant').addEventListener('click', function() {
                                        const container = document.getElementById('variants-container');

                                        // Sao chép dòng biến thể đầu tiên
                                        const newVariant = document.querySelector('.variant-row').cloneNode(true);

                                        // Xóa giá trị của các input trong dòng mới
                                        clearInputs(newVariant);

                                        // Thêm dòng mới vào container
                                        container.appendChild(newVariant);
                                    });

                                    function clearInputs(variantRow) {
                                        const inputs = variantRow.querySelectorAll('input');
                                        inputs.forEach(input => {
                                            input.value = ''; // xóa giá trị trong các input
                                        });
                                    }

                                    document.getElementById('variants-container').addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-variant')) {
                                            const variantRows = document.querySelectorAll('.variant-row'); // Lấy tất cả các dòng biến thể
                                            if (variantRows.length > 1) { // Kiểm tra nếu còn nhiều hơn 1 dòng
                                                e.target.closest('.variant-row').remove(); // Xóa dòng biến thể
                                            } else {
                                                alert('Không thể xóa biến thể!');
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Thêm sản phẩm</button>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
