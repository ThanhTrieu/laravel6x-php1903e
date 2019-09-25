@extends('admin.layout')
{{-- ke thua file layout --}}

@section('title','This is dashboard')

{{-- day view con nay sang file layout dang doi san --}}
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Overview</li>
</ol>
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <h2>This is dashboard</h2>
  </div>
</div>
@endsection