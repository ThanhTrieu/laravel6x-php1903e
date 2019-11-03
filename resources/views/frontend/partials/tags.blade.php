<div class="sidebar-box">
  <h3 class="heading">@lang('common.tags')</h3>
  <ul class="tags">
    @foreach($view['lstTags'] as $key => $tag)
    <li><a href="#">{{ $tag['name_tag'] }}</a></li>
    @endforeach
  </ul>
</div>