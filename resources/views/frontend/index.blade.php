@extends('frontend.layouts.master')
@section('content')



  @include('frontend.partials.hero-section')
  <!-- end hero -->
  
  <div class="lonyo-content-shape1">
    <img src="{{ asset('frontend') }}/assets/images/shape/shape1.svg" alt="">
  </div>
  
  @include('frontend.partials.features-section')
  <!-- end content -->

  @include('frontend.partials.after-feature-section-one')
  <!-- end content -->

  @include('frontend.partials.after-feature-section-two')
  <!-- end content -->

  <div class="lonyo-content-shape3">
    <img src="{{ asset('frontend') }}/assets/images/shape/shape2.svg" alt="">
  </div>
  <!-- end content -->

  @include('frontend.partials.video-section')
  <!-- end content -->

  <div class="lonyo-content-shape1">
    <img src="{{ asset('frontend') }}/assets/images/shape/shape3.svg" alt="">
  </div>
  <!-- end video -->

  @include('frontend.partials.testimonial-section')
  <!-- end testimonial -->

  @include('frontend.partials.faq-section')
  <!-- end content -->

  <div class="lonyo-content-shape3">
    <img src="{{ asset('frontend') }}/assets/images/shape/shape2.svg" alt="">
  </div>
  <!-- end faq -->

  @include('frontend.partials.cta-section')
  <!-- end cta -->



@endsection



