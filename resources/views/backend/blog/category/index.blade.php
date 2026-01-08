@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Blog Category</h4>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#catgoryCreateModal">Add
                        Category</button>
                </div>
            </div>

            <!-- start row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        {{-- <div class="card-header">
                            <h5 class="card-title mb-0">Basic Datatable</h5>
                        </div> --}}
                        <!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $item)
                                        <tr class="align-middle">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>
                                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#catgoryEditModal" id="{{ $item->id }}" onclick="categoryEdit(this.id)"><i class="mdi mdi-pencil"></i></button>

                                                <form action="{{ route('admin.blog.category.destroy', $item->id) }}" method="POST"
                                                    class="delete-form d-inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger delete-btn">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
    </div>


    {{-- Create Modal Box --}}
    <div class="modal fade" id="catgoryCreateModal" tabindex="-1" aria-labelledby="catgoryCreateModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catgoryCreateModalLabel">Create Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.blog.category.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="form-group col-xxl-6">
                                <div>
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                                </div>
                            </div><!--end col-->                                                 
                            
                            <div class="form-group col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form> <!-- end form -->
                </div> <!-- end modal body -->
            </div> <!-- end modal content -->
        </div>
    </div>

    {{-- Edit Modal Box --}}
    <div class="modal fade" id="catgoryEditModal" tabindex="-1" aria-labelledby="catgoryEditModalLabel"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catgoryEditModalLabel">Edit Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.blog.category.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="catid" name="catid">
                        <div class="row g-3">
                            <div class="form-group col-xxl-6">
                                <div>
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" name="name" id="catname" placeholder="Enter name">
                                </div>
                            </div><!--end col-->                                                 
                            
                            <div class="form-group col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form> <!-- end form -->
                </div> <!-- end modal body -->
            </div> <!-- end modal content -->
        </div>
    </div>

<script>
    function categoryEdit(id){
        $.ajax({
            type: 'GET',
            url: '/admin/blog/category/edit/'+id,
            dataType: 'json',
            
            success: function(data){
                // console.log(data);
                $('#catname').val(data.name);                
                $('#catid').val(data.id);                
            }
        })
    }
</script>
@endsection
