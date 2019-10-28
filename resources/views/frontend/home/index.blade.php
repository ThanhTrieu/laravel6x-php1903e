@extends('frontend.master')
    
  @section('slider')
    <section class="site-section pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">

            <div class="owl-carousel owl-theme home-slider">
            @foreach($slider as $key => $item)
              <div>
                <a href="{{ route('fr.detailBlog',['slug' => $item['slug']]) }}" 
                  class="a-block d-flex align-items-center height-lg" 
                  style="background-image: url('{{ URL::to('/') }}/upload/images/{{ $item['avatar'] }}');"
                >
                  <div class="text half-to-full">
                    <span class="category mb-5">{{ $item['name_cate'] }}</span>
                    <div class="post-meta">
                      <span class="author mr-2"> {{ $item['fullname'] }} </span>&bullet;
                      <span class="mr-2"> {{ date('d/m/Y', strtotime($item['publish_date'])) }} </span> &bullet;
                      <span class="ml-2"><span class="fa fa-comments"></span> {{ $item['count_view'] }} </span>
                      
                    </div>
                    <h3>{{ $item['title'] }}</h3>
                    <p> {!! $item['sapo'] !!}</p>
                  </div>
                </a>
              </div>
            @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->
  @endsection

  @section('lastest-home')
    @if(!empty($lastest))
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Latest Posts</h2>
        </div>
      </div>
    @endif
  @endsection

  @section('content')
    <div class="col-md-12 col-lg-8 main-content">
      <div class="row">
        @foreach($lastest as $key => $item)
          <div class="col-md-6">
            <a href="{{ route('fr.detailBlog',['slug' => $item['slug']]) }}" class="blog-entry element-animate" data-animate-effect="fadeIn">
              <img src="{{ URL::to('/') }}/upload/images/{{ $item['avatar'] }}" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2">{{ $item['fullname'] }}</span>&bullet;
                  <span class="mr-2"> {{ date('d/m/Y', strtotime($item['publish_date'])) }} </span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> {{ $item['count_view'] }}</span>
                </div>
                <h2>{{ $item['title'] }}</h2>
              </div>
            </a>
          </div>
        @endforeach
      </div>
      @if(!empty($lastest))
      <div class="row mt-5">
        <div class="col-md-12 text-center">
          {{ $paginate->links() }}
        </div>
      </div>
      @endif
    </div>
  @endsection

          

    
      