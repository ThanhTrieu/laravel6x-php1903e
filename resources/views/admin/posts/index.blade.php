@extends('admin.layout')
{{-- ke thua file layout --}}

@section('title','This is posts')

{{-- day view con nay sang file layout dang doi san --}}
@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Posts</a>
  </li>
  <li class="breadcrumb-item active">Overview</li>
</ol>
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <a href="{{ route('admin.createPost') }}" class="btn btn-primary btn-sm">Create post</a>
  </div>
</div>
@endsection