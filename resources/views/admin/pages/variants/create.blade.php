@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Add Variant</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                                <li class="breadcrumb-item active">Add variant</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form id="createproduct-form" autocomplete="off" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label" for="product-title-input">Name Variant</label>
                                        <input type="hidden" class="form-control" id="formAction" name="formAction"
                                            value="add">
                                        <input type="text" class="form-control d-none" id="product-id-input">
                                        <input type="text" class="form-control" id="product-title-input" value=""
                                            placeholder="Enter variant" required>
                                    </div>
                                </div>
                                <div class="text-end mb-3">
                                    <a href="/variant"><button type="button" class="btn btn-primary w-sm">List</button></a>
                                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>
@endsection
