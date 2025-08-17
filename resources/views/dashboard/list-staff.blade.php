@extends('layout.app')


@section('content')
<div class="content-body ">
    <div class="warper container-fluid">
        <div class="create_invoice main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Staff Management</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                        <li class="breadcrumb-item active"><a href="create-invoice.html">Search</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title"> </h4>
                        </div>
                        <div class="card-body">
                            <a id="export" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export to Excel</a>
                            <br><br>
                            @if (count($data))
                            <div class="table-responsive">
                                <table id="example1" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th>Created Date</th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Grade</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Unit / Division</th>
                                            <th>User Category</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($data as $item)
                                        <tr>
                                            
                                            <td>{{$item->created_at}}</td>
                                            <td align="center">
                                                @if (!empty($item->photoUrl))
                                                <img src="data:image/jpeg;base64,{{$item->photoUrl}}" alt="people" height="40" width="40">
                                                
                                                @else
                                                <img src="{{asset('avater.png')}}" alt="people" height="40" width="40">
                                                @endif
                                            </td>
                                            <td> {{$item->name}}</td>
                                            <td>{{$item->title}}</td>
                                            <td> {{$item->username}}</td>
                                            <td> {{$item->email}}</td>
                                            <td> <b>{{$item->category}}</b></td>
                                            <td> {{$item->userCategory()}}</td>
                                            <td>
                                                <a target="_blank" href="{{route('staff-bio-information',Crypt::encrypt($item->username))}}"> <span class='fas fa-eye' style="color:green;"></span> </a>
                                            </td>
                                           
                                        </tr>
                                        @endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            @endif
                            
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
        filename:'staff-list-'+d

    });

    });
</script>
    
@endsection