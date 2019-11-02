<div class="col-md-12 col-lg-8 main-content">
  <div class="row mb-5 mt-5">
    <div class="col-md-12">
    @foreach($listData as $key => $cate)
      <div class="post-entry-horzontal">
        <a href="{{ route('fr.detailBlog',['slug'=>$cate['slug']]) }}">
          <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url('{{ URL::to('/') }}/upload/images/{{ $cate['avatar'] }}');"></div>
          <span class="text">
            <div class="post-meta">
              <span class="author mr-2"> {{ $cate['fullname'] }} </span>&bullet;
              <span class="mr-2"> {{ date('d/m/Y', strtotime($cate['publish_date'])) }} </span> &bullet;
              <span class="mr-2">{{ $cate['name_cate'] }}</span> &bullet;
              <span class="ml-2"><span class="fa fa-comments"></span> {{ $cate['count_view'] }} </span>
            </div>
            <h2>{{ $cate['title'] }}</h2>
          </span>
        </a>
      </div>
    @endforeach
    </div>
  </div>
</div>