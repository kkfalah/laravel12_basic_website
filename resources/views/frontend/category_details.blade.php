@extends('frontend.layouts.master')

@section('content')


    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">{{ $category->name }}</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}" alt="right-arrow">
                                </li>
                                <li aria-current="page">Blog Category: {{ $category->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="lonyo-section-padding9 overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($blogs)
                        @foreach ($blogs as $item)
                            <div class="lonyo-blog-wrap" data-aos="fade-up" data-aos-duration="500">
                                <div class="lonyo-blog-thumb">
                                    <img src="{{ !empty($item->image) ? Storage::url($item->image) : asset('frontend/assets/images/blog/b1.png') }}"
                                        alt="{{ $item->title }}">
                                </div>
                                <div class="lonyo-blog-meta">
                                    <ul>
                                        <li>
                                            <a href="{{ url('blog/'.$item->slug) }}"><img src="{{ asset('frontend/assets/images/blog/date.svg') }}"
                                                    alt="">{{ $item->created_at->format('F d, Y') }}</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                                <div class="lonyo-blog-content">
                                    <h2><a href="{{ url('blog/'.$item->slug) }}">{{ $item->title }}</a></h2>
                                    <div>{!! Str::limit($item->description, 250, '...') !!}</div>
                                </div>
                                <div class="lonyo-blog-btn">
                                    <a href="{{ url('blog/'.$item->slug) }}" class="lonyo-default-btn blog-btn">continue reading</a>
                                </div>
                            </div>
                        @endforeach
                        {{ $blogs->links('vendor.pagination.lonyo') }}
                    @else
                        <div class="lonyo-blog-wrap" data-aos="fade-up" data-aos-duration="500">No Posts to display</div>
                    @endif


                </div>
                <div class="col-lg-4">
                    <div class="lonyo-blog-sidebar" data-aos="fade-left" data-aos-duration="700">
                        <div class="lonyo-blog-widgets">
                            <form action="#">
                                <div class="lonyo-search-box">
                                    <input type="search" placeholder="Type keyword here">
                                    <button id="lonyo-search-btn" type="button"><i class="ri-search-line"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Categories:</h4>
                            <div class="lonyo-blog-categorie">
                                <ul>
                                  @foreach ($categories as $category)
                                    <li><a href="{{ url('blog/category/'.$category->slug) }}">{{ $category->name }} <span>({{ $category->blogs_count }})</span></a></li>
                                  @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Recent Posts</h4>
                            @foreach ($recentposts as $recentpost)
                              
                            <a class="lonyo-blog-recent-post-item" href="{{ url('blog/'.$recentpost->slug) }}">
                                <div class="lonyo-blog-recent-post-thumb">
                                    <img 
                                    src="{{ !empty($recentpost->image) ? Storage::url($recentpost->image) : asset('frontend/assets/images/blog/b4.png') }}" style="width: 150px; height:120px"
                                    alt="{{ $recentpost->title }}"
                                    >
                                </div>
                                <div class="lonyo-blog-recent-post-data">
                                    <ul>
                                        <li><img src="{{ asset('frontend/assets/images/blog/date.svg') }}" alt="">{{ $recentpost->created_at->format('M d, Y') }}</li>
                                    </ul>
                                    <div>
                                        <h4>{{ $recentpost->title }}</h4>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            
                            
                        </div>
                        <div class="lonyo-blog-widgets">
                            <h4>Tags</h4>
                            <div class="lonyo-blog-tags">
                                <ul>
                                    <li><a href="single-blog.html">Software</a></li>
                                    <li><a href="single-blog.html">Business</a></li>
                                    <li><a href="single-blog.html">App</a></li>
                                    <li><a href="single-blog.html">Solutions</a></li>
                                    <li><a href="single-blog.html">Finance</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lonyo-content-shape">
        <img src="{{ asset('frontend/assets/images/shape/shape2.svg') }}" alt="">
    </div>

    @include('frontend.partials.cta-section')

    <!-- end cta -->



@endsection
