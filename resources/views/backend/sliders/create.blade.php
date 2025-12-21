@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Create Slider</h4>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.slider.index') }}" class="btn btn-primary">Back</a>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">



                            <div class="tab-pan active show pt-4">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card border mb-0">

                                                <div class="card-header">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <h4 class="card-title mb-0">Add Slider</h4>
                                                        </div><!--end col-->
                                                    </div>
                                                </div>

                                                <div class="card-body">
                                                    <form action="{{ route('admin.slider.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-lg-6 col-xl-6">

                                                                <div class="form-group mb-3 row">
                                                                    <label class="form-label">Title</label>
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <input class="form-control @error('title') is-invalid @enderror" type="text"
                                                                            name="title" id="title" placeholder="title"
                                                                            aria-describedby="basic-addon1"
                                                                            value="{{ old('title') }}">
                                                                            @error('title')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="form-group mb-3 row">
                                                                    <label class="form-label">Description</label>
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <textarea class="form-control" rows="3" name="description" id="description" placeholder="description"> </textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-3 row">
                                                                    <label class="form-label">Link</label>
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <input class="form-control @error('link') is-invalid @enderror" type="text"
                                                                            name="link" id="link"
                                                                            placeholder="Link"
                                                                            aria-describedby="basic-addon1"
                                                                            value="{{ old('link') }}">
                                                                            @error('link')
                                                                                <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                    </div>
                                                                </div>


                                                            </div>
                                                            <div class="col-lg-6 col-xl-6">

                                                                <div class="form-group mb-3 row">
                                                                    <label class="form-label">Image</label>
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <input class="form-control" type="file"
                                                                            name="image" id="image"
                                                                            placeholder="Image"
                                                                            aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-3 row">
                                                                    <label class="form-label"></label>
                                                                    <div class="col-lg-12 col-xl-12">
                                                                        <img id="showImage"
                                                                            src="{{ asset('backend/assets/images/default-image.png') }}"
                                                                            class="rounded-2xl img-thumbnail float-start"
                                                                            style="height: 250px"
                                                                            alt=" ">
                                                                    </div>
                                                                </div>

                                                               
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save</button>

                                                                </div>
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
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>

    <script>
        const stars = document.querySelectorAll("#starRating .mdi");
        const ratingValue = document.getElementById("ratingValue");

        stars.forEach((star) => {
            star.addEventListener("click", function() {
                let value = this.getAttribute("data-value");
                ratingValue.value = value;

                stars.forEach((s, index) => {
                    if (index < value) {
                        s.classList.remove("mdi-star-outline");
                        s.classList.add("mdi-star", "text-warning");
                    } else {
                        s.classList.remove("mdi-star", "text-warning");
                        s.classList.add("mdi-star-outline");
                    }
                });
            });
        });
    </script>
@endsection
