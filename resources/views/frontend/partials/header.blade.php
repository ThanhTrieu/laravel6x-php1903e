<header role="banner">
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-9 social">
          <a href="#"><span class="fa fa-twitter"></span></a>
          <a href="#"><span class="fa fa-facebook"></span></a>
          <a href="#"><span class="fa fa-instagram"></span></a>
          <a href="#"><span class="fa fa-youtube-play"></span></a>
        </div>
        <div class="col-3 search-top">
          <!-- <a href="#"><span class="fa fa-search"></span></a> -->
          <form action="#" class="search-top-form">
            <span class="icon fa fa-search"></span>
            <input type="text" id="s" placeholder="Type keyword to search...">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container logo-wrap">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
        <h1 class="site-logo"><a href="{{ route('fr.home') }}">TrieuNT's Blog</a></h1>
      </div>
    </div>
  </div>
  
  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mx-auto">
          @foreach($view['treeCate'] as $key => $cate)
            @if(empty($cate['subCate']))
              <li class="nav-item">
                {{-- ko phai la link sang list cate --}}
                <a class="nav-link active" href="#">{{ $cate['name_cate'] }}</a>
              </li>
            @else
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="dropdown-{{ $cate['id'] }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $cate['name_cate'] }}</a>
                <div class="dropdown-menu" aria-labelledby="dropdown-{{ $cate['id'] }}">
                  @foreach($cate['subCate'] as $k => $item)
                    <a class="dropdown-item" href="{{ route('fr.categories',['slug' => Str::slug($item['name_cate'],'-'), 'id' => $item['id']]) }}">{{ $item['name_cate'] }}</a>
                  @endforeach
                </div>
              </li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
  </nav>
</header>
<!-- END header -->