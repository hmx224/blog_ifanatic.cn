@if(Session::has('flash_success'))
    <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-check"></i>{{ session('flash_success') }}
    </div>
@elseif(Session::has('flash_warning'))
    <div class="alert alert-warning">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-warning"></i>{{ session('flash_warning') }}
    </div>
@elseif(Session::has('flash_info'))
    <div class="alert alert-info">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-info"></i>{{ session('flash_info') }}
    </div>
@elseif(Session::has('flash_error'))
    <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-ban"></i>{{ session('flash_error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

