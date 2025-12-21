@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Sliders</h4>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">Add Slider</a>
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
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sliders as $key => $item)
                                        <tr class="align-middle">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ Str::limit($item->description, 20, '...') }}</td>
                                            <td><img 
                                                src="{{ !empty($item->image) ? Storage::url($item->image) : asset('backend/assets/images/default-image.png') }}"
                                                    alt="{{ $item->title }}"
                                                    class="rounded-2xl img-thumbnail" style="height: 50px"></td>
                                            
                                            <td>{{ $item->link }}</td>
                                            <td>
                                                <a href="{{ route('admin.slider.edit', $item->id) }}"
                                                    class="btn btn-success"><i class="mdi mdi-pencil"></i></a>
                                                <a id="delete" href="{{ route('admin.slider.destroy', $item->id) }}"
                                                    class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                <form action="{{ route('admin.slider.destroy', $item->id) }}"
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
