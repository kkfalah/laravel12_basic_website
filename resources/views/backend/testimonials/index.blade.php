@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Testimonials</h4>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.testimonial.create') }}" class="btn btn-primary">Add Testimonial</a>
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
                                        <th>Position</th>
                                        <th>Image</th>
                                        <th>Rating</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $key => $item)
                                        <tr class="align-middle">
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->position }}</td>
                                            <td><img 
                                                src="{{ !empty($item->image) ? Storage::url($item->image) : asset('backend/assets/images/default-profile.jpg') }}"
                                                    alt="{{ $item->name }}"
                                                    class="rounded-2xl avatar-lg img-thumbnail w-10 h-10"></td>
                                            <td>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="mdi {{ $i <= $item->rating ? 'mdi-star text-warning' : 'mdi-star-outline' }}"></i>
                                                @endfor
                                            </td>
                                            <td>{{ Str::limit($item->message, 20, '...') }}</td>
                                            <td>
                                                <a href="{{ route('admin.testimonial.edit', $item->id) }}"
                                                    class="btn btn-success"><i class="mdi mdi-pencil"></i></a>
                                                <a id="delete" href="{{ route('admin.testimonial.destroy', $item->id) }}"
                                                    class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                                                <form action="{{ route('admin.testimonial.destroy', $item->id) }}"
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
