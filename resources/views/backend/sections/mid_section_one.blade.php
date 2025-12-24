@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Middle Section One</h4>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr class="align-middle">
                                            <td> 1 </td>
                                            <td>{{ $midSectionOne->title }}</td>
                                            <td>{{ Str::limit($midSectionOne->description, 20, '...') }}</td>
                                            <td><img 
                                                src="{{ !empty($midSectionOne->image) ? Storage::url($midSectionOne->image) : asset('backend/assets/images/default-image.png') }}"
                                                    alt="{{ $midSectionOne->title }}"
                                                    class="rounded-2xl img-thumbnail" style="height: 50px"></td>
                                            
                                            <td>
                                                <a href="{{ route('admin.section.one.edit') }}"
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
