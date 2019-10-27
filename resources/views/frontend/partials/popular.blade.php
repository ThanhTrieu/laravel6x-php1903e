<!-- END sidebar-box -->  
<div class="sidebar-box">
  <h3 class="heading">Popular Posts</h3>
  <div class="post-entry-sidebar">
    <ul>
      @foreach($view['popularPost'] as $key => $item)
      <li>
        <a href="#">
          <img src="{{ URL::to('/') }}/upload/images/{{ $item['avatar'] }}" alt="Image placeholder" class="mr-4">
          <div class="text">
            <h4>{{ $item['title'] }}</h4>
            <div class="post-meta">
              <span class="mr-2">{{ date('d/m/Y', strtotime($item['publish_date'])) }}</span>
            </div>
          </div>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</div>
<!-- END sidebar-box -->