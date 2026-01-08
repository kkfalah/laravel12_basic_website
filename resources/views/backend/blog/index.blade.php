@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Blog Posts</h4>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add Post</a>
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
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $key => $item)
                                        <tr class="align-middle">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->slug }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td><img 
                                                    src="{{ !empty($item->image) ? Storage::url($item->image) : asset('backend/assets/images/default-image.png') }}"
                                                        alt="{{ $item->name }}"
                                                        class="rounded-2xl avatar-lg img-thumbnail w-10 h-10">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.blog.edit', $item->id) }}"
                                                    class="btn btn-success"><i class="mdi mdi-pencil"></i></a>
                                                
                                                <form action="{{ route('admin.blog.destroy', $item->id) }}"
                                                    method="POST" class="delete-form d-inline">
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
@endsection
