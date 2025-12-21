@extends('backend.layouts.master')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Profile</h4>
                </div>

                {{-- <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Components</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div> --}}
            </div>

            <!-- start row -->
            <!-- <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/images/users/user-11.jpg" class="rounded-2 avatar-xxl" alt="image profile">
    
                                        <div class="overflow-hidden ms-4">
                                            <h4 class="m-0 text-dark fs-20">Phoenix Baker</h4>
                                            <p class="my-1 text-muted fs-16">Passionate Software Engineer Crafting Innovative Solutions</p>
                                            <span class="fs-15"><i class="mdi mdi-message me-2 align-middle"></i>Speaks: <span>English <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">native</span> , Spanish, Turkish </span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ !empty($user->photo) ? Storage::url($user->photo) : asset('backend/assets/images/default-profile.jpg') }}"
                                        class="rounded-circle avatar-xxl img-thumbnail float-start"
                                        alt="{{ $user->name }}">

                                    <div class="overflow-hidden ms-4">
                                        <h4 class="m-0 text-dark fs-20">{{ $user->name }}</h4>
                                        <h5 class="my-1 text-muted fs-16">{{ $user->email }}</h5>
                                        <h5 class="my-1 text-muted fs-16">{{ $user->phone }}</h5>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pan active show pt-4" id="profile_setting" role="tabpanel">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Personal Information</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <form action="{{ route('admin.profile.update') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf


                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Full Name</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-account-outline"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        name="name" id="name" placeholder="name"
                                                                        aria-describedby="basic-addon1"
                                                                        value="{{ $user->name }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Email Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-email-outline"></i></span>
                                                                    <input type="email" name="email" id="email"
                                                                        class="form-control" disabled
                                                                        value="{{ $user->email }}" placeholder="Email"
                                                                        aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Contact Phone</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-phone-outline"></i></span>
                                                                    <input class="form-control" type="text"
                                                                        name="phone" id="phone" placeholder="Phone"
                                                                        aria-describedby="basic-addon1"
                                                                        value="{{ $user->phone }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Address</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address">{{ $user->address }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Profile Photo</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i
                                                                            class="mdi mdi-account-box-outline"></i></span>
                                                                    <input class="form-control" type="file"
                                                                        name="photo" id="photo"
                                                                        placeholder="Profile Photo"
                                                                        aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label"></label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <img id="showPhoto"
                                                                    src="{{ !empty($user->photo) ? Storage::url($user->photo) : asset('backend/assets/images/default-profile.jpg') }}"
                                                                    class="rounded-2xl avatar-xxl img-thumbnail float-start"
                                                                    alt="{{ $user->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Save</button>
                                                                
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div><!--end card-body-->
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Change Password</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>

                                                <div class="card-body mb-0">
                                                    <form action="{{ route('admin.password.update') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Old Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input
                                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                                    type="password" name="old_password" id="old_password"
                                                                    placeholder="Old Password">
                                                                @error('old_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">New Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input
                                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                                    type="password" name="new_password" id="new_password"
                                                                    placeholder="New Password">
                                                                @error('new_password')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3 row">
                                                            <label class="form-label">Confirm Password</label>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <input
                                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                                    type="password" name="new_password_confirmation"
                                                                    id="new_password_confirmation" placeholder="Confirm Password">
                                                                @error('new_password_confirmation')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <button type="submit" class="btn btn-primary">Change
                                                                    Password</button>
                                                                
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!--end card-body-->
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div> <!-- end education -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showPhoto').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
