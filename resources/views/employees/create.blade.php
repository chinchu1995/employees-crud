@extends('index')

@section('styles')
    <style>
        .form-control.error{
            border-color: #dc3545;
        }
        .error{
            color:#dc3545;
        }
    </style>
@stop

@section('content')

<section class="content-header"></section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Employee</h3>
                </div>
                
                <!-- /.card-header -->
                <form id="form" method="post" action="{{route('employees.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div id="app-msgs">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                    <span class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                                    @if ($errors->has('email'))
                                    <span class="error">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                    @if ($errors->has('photo'))
                                    <span class="error">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <select name="designation" class="form-control" >
                                        @foreach($designations as $designation)
                                        <option value="{{$designation->id}}">{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('designation'))
                                    <span class="error">{{ $errors->first('designation') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script src="{{url('assests/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{url('assests/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="{{url('assests/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script>

$(function () {
  bsCustomFileInput.init();
});
$('#form').validate({
    rules: {
        name: {
            required: true,
            minlength: 3,
        },
        email: {
            required: true,
            email: true,
        },
    },
    messages: {
        name: {
            required: "Please enter name",
            minlength: "Please enter at least 3 characters"
        },
        email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
        },
    },
    errorElement: 'span'
});
</script>
@stop