<div class="sidebar-box">
  <h3 class="heading">Categories</h3>
  <ul class="categories">
  	@foreach($view['catePost'] as $key => $item)
    	<li><a href="#">{{ $item['name_cate'] }} <span>({{ count($item['list_post']) }})</span></a></li>
    @endforeach
  </ul>
</div>
<!-- END sidebar-box -->