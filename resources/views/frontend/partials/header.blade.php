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
          {{-- <form action="{{ route('fr.searchBlog') }}" class="search-top-form" method="get">
            <button type="submit" class="icon fa fa-search btn btn-primary"></button>
            <input name="s" type="text" id="s" placeholder="Type keyword to search..." value="{{ $view['keyword'] }}">
          </form> --}}

          <form class="search-top-form form-inline">
            <input name="s" type="text" id="s" placeholder="Type keyword to search...">
            <img id="js-loading" src="/frontend/images/loading-32.gif" alt="" style="display: none;">
          </form>

        </div>
      </div>
    </div>
  </div>

  <div class="container" id="js-search" style="display: none;"></div>

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
@push('scripts')
  <script type="text/javascript">
    $(function(){
      $('#s').keyup(function() {
        var self = $(this);
        var timeout;

        clearTimeout(timeout);

        timeout = setTimeout(function(){
          var keyword = self.val().trim();
          if(keyword.length > 0){
            $.ajax({
              url: "{{ route('fr.ajaxSearch') }}",
              type: "GET",
              data: {key : keyword},
              //dataType: "html",
              beforeSend: function(){
                $('#js-loading').show();
                $('#js-search').hide();
              },
              success: function(data){
                $('#js-loading').hide();
                $('#js-search').html(data);
                $('#js-search').show();
              }
            });
          }
        }, 1000);
      });
    })
  </script>
@endpush




