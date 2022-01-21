@extends('index')

@section('styles')
<link rel="stylesheet" href="{{url('assests/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assests/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@stop

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 justify-content-end mr-1">
            <div class="col-sm-6">
                <div class="text-right">
                    <a href="{{route('employees.create')}}" class="btn btn-primary btn-sm">Add New</a>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employees List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="app-msgs">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <table id="employees-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No#</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Designation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=0)
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{$i=$i+1}}</td>
                                <td>{{$employee->name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->designations->title}}</td>
                                <td>
                                    <a href="{{route('employees.edit',$employee->id)}}" class="d-inline-block mr-1" title="Edit"><i class="far fa-edit"></i></a>
                                    <a href="{{route('employees.delete',$employee->id)}}" class="d-inline-block" title="Delete" onclick="return confirm('Are you sure you want to delete this item')"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
<script src="{{url('assests/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assests/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready( function () {
        $('#employees-table').DataTable({
            "responsive": true,
            "bLengthChange": false,
            "columnDefs": [ {
                "targets": [0,4],
                "searchable": false
            } ]
        });
    });
</script>
@stop