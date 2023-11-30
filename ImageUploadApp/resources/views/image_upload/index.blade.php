<!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Simple Image Uploader App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="container mt-5">
            @if(Session::get('success', false))
              <?php $data = Session::get('success'); ?>
              @if (is_array($data))
                  @foreach ($data as $msg)
                      <div class="alert alert-success" role="alert">
                          <i class="fa fa-check"></i>
                          {{ $msg }}
                      </div>
                  @endforeach
              @else
                  <div class="alert alert-success" role="alert">
                      <i class="fa fa-check"></i>
                      {{ $data }}
                  </div>
              @endif

              <img src="images/{{ Session::get('image') }}" width="200px">
            @endif

            <form action="{{ route('image-upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
        
                    <div class="col-md-6">
                        <input type="file" name="image" class="form-control">
                        @if ($errors->has('image'))
                            <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
         
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
         
                </div>
            </form>
        </div>
    </body>
</html>