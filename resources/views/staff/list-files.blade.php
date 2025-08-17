@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Files Created</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">MOF Staff List</a></li>
                    </ol>
                </div>
            </div>
           

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">List | Files</h4>
                        </div>
                        <div class="card-body">
                            <a id="export" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export to Excel</a>
                            <br><br>
                            <div class="table-responsive">
                                <table id="example1" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th>Created Date</th>
                                            <th>File Number</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Institution</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         {{-- @foreach ($listStaff as $item)
                                        <tr>
                                            
                                            <td>{{$item->created_at}}</td>
                                            <td> {{$item->name}}</td>
                                            <td>{{$item->userGrade()}}</td>
                                            <td> {{$item->email}}</td>
                                          
                                            <td> {{$item->userCategory()}}</td>
                                            <td>
                                            <a href="{{route('reassign_user_category',Crypt::encrypt($item->id))}}"> <span
                                                        class='fas fa-edit' style="color:blue;"></span> </a>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>

@endsection


@section('java_script')

<script type="text/javascript" src="{{asset('assets/js/table-data.js')}}"></script>

<script type="text/javascript">
    $('#export').click(function(){
        const d = new Date();
    $('#example1').table2excel({
        exclude:".noExl",
        name:"Report",
        filename:'File-List-'+d

    });

    });
</script>

@endsection