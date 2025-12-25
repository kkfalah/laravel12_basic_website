@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Middle Section Video</h4>
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

                        <div class="card-body overflow-x-auto">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Video Link</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr class="align-middle">
                                            <td> 1 </td>
                                            <td>{{ $midSectionVideo->title }}</td>
                                            <td>{{ Str::limit($midSectionVideo->description, 20, '...') }}</td>
                                            <td>{{ $midSectionVideo->link }}</td>
                                            <td>{{ $midSectionVideo->video_link }}</td>
                                            <td><img 
                                                src="{{ !empty($midSectionVideo->image) ? Storage::url($midSectionVideo->image) : asset('backend/assets/images/default-image.png') }}"
                                                    alt="{{ $midSectionVideo->title }}"
                                                    class="rounded-2xl img-thumbnail" style="height: 50px"></td>
                                            
                                            <td>
                                                <a href="{{ route('admin.section.video.edit') }}"
                                                    class="btn btn-success"><i class="mdi mdi-pencil"></i></a>
                                                
                                                
                                            </td>
                                        </tr>
                                    

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
