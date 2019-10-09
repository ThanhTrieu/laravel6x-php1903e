<!DOCTYPE html>
<html lang="en">

<head>
  <base href="{{ asset('') }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if($messages)
          <div class="alert alert-danger">
            <h6>{{ $messages }}</h6>
          </div>
        @endif

        <form action="{{ route('admin.handleLogin') }}" method="post">
          @csrf
          <div class="form-group">
            <div class="form-label-group">
              <input type="text " id="txtEmail" name="txtEmail" class="form-control" placeholder="Email address" autofocus="autofocus">
              <label for="txtEmail">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="txtPass" class="form-control" placeholder="Password" name="txtPass">
              <label for="txtPass">Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
