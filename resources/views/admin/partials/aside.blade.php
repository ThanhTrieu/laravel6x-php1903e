<ul class="sidebar navbar-nav">
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.posts') }}">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Posts</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.category') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Categories</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.tag') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Tags</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.user') }}">
      <i class="fas fa-fw fa-table"></i>
      <span>Users</span></a>
  </li>
</ul>