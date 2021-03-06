@extends('admin.layout')
{{-- ke thua file layout --}}

@section('title','This is create posts')
@push('stylesheets')
	<link href="{{ asset('admin/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

	<link href="{{ asset('admin/css/multiple-select.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script type="text/javascript" src="{{ asset('admin/js/posts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.js') }}"></script>

	<script type="text/javascript" src="{{ asset('admin/js/multiple-select.min.js') }}"></script>

	<script type="text/javascript">
		$(function () {
			$('#publishDate').datetimepicker({
				format:'d-m-Y H:m:s',
			});
			$(".js-multi-tag").select2();
		})
	</script>
@endpush

@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{ route('admin.posts') }}">List posts</a>
  </li>
  <li class="breadcrumb-item active">Create post</li>
</ol>
<div class="row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12">
		<h3> Tao bai viet</h3>
	</div>
</div>
<hr>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($errorPublisDate)
	<div class="alert alert-danger">
		<span>{{ $errorPublisDate }}</span>
	</div>
@endif

@if($errorAvatar)
	<div class="alert alert-danger">
		<span>{{ $errorAvatar }}</span>
	</div>
@endif

<form action="{{ route('admin.handlCreatePost') }}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		  <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		    <div class="form-group">
		    	<label for="titlePost">Title (*)</label>
		    	<input type="text" class="form-control" id="titlePost" name="titlePost">
		    </div>
		    <div class="form-group">
		    	<label for="sapoPost">Sapo (*)</label>
		    	<textarea class="form-control" id="sapoPost" name="sapoPost" rows="3"></textarea>
		    </div>
		    <div class="form-group">
		    	<label for="avatarPost">Avatar (*)</label>
		    	<input type="file" class="form-control" id="avatarPost" name="avatarPost">
		    </div>
		  </div>
		  <div class="col-12 col-sm-12 col-md-6 col-lg-6">
		    <div class="form-group">
		    	<label for="languagePost">Languae (*)</label>
		    	<select class="form-control" id="languagePost" name="languagePost">
		    		<option value="1">Vietnamese</option>
		    		<option value="2">English</option>
		    	</select>
		    </div>
		    <div class="form-group">
		    	<label for="catePost">Categories (*)</label>
		    	<select class="form-control" id="catePost" name="catePost">
		    		<option value="">-- choose --</option>
		    		@foreach($cates as $key => $item)
		    			<option value="{{ $item['id'] }}">{{ $item['name_cate'] }}</option>
					@endforeach
		    	</select>
		    </div>
		    <div class="form-group">
		    	<label for="publishDate">Publish date</label>
		    	<input type="text" name="publishDate" id="publishDate" class="form-control">
		    </div>
		    {{-- chon tag bai viet --}}
		    <div class="form-group">
		    	<label for="tagsPost"> Tags (*)</label>
		    	<select class="form-control js-multi-tag" id="tagsPost" name="tagsPost[]" multiple="multiple">
					@foreach($tags as $key => $item)
						<option value="{{ $item['id'] }}">{{ $item['name_tag'] }}</option>
					@endforeach
		    	</select>
		    </div>
		    <button class="btn btn-primary" type="submit">publish post</button>
		    <button class="btn btn-secondary" type="reset  ">cancel</button>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12">
			<div class="form-group">
		    	<label for="contentPost">Content (*)</label>
		    	<textarea class="form-control" id="contentPost" name="contentPost" rows="5"></textarea>
		    </div>
		</div>
	</div>
</form>
@endsection