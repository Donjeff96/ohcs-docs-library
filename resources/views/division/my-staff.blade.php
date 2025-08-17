@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Divisional Management</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Divisional Management</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Divisional Staffs</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="example1" class="display nowrap">
                                            <thead>
                                                <tr>
                                                    <th># </th>
                                                    <th>Name</th>
                                                    <th>Title</th>
                                                    <th>Username</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
            
                                                @for ($i = 1; $i <= (int)$count; $i++)
                                                <tr>
                                                    
                                                    <td align="center">
                                                        
                                                        @if (key_exists('thumbnailphoto',$data[$i-1]))
                                                        <img src="data:image/jpeg;base64,{{base64_encode($data[$i-1]['thumbnailphoto'][0])}}" alt="people" height="40" width="40">
                                                        
                                                        @else
                                                        <img src="{{asset('avater.png')}}" alt="people" height="40" width="40">
                                                        @endif
                                                    </td>
                                                    <td><b>{{$data[$i-1]['displayname'][0]}}</b></td>
                                                    <td>
                                                        @if (key_exists('title',$data[$i-1]))
                                                        {{ $data[$i-1]['title'][0]}}
                                                        @else
                                                        Not available
                                                        @endif
                                                    </td>
                                                    <td>{{ $data[$i-1]['samaccountname'][0]}}</td> 
                                                    <td>
                                                        <a target="_blank" href="{{route('staff-bio-information',Crypt::encrypt($data[$i-1]['userprincipalname'][0]))}}"> <span class='fas fa-eye' style="color:green;"> View</span> </a>
                                                    </td>
                                                </tr>
                                                @endfor
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

       
    </div>
</div>
  
@endsection

@section('java_script')
   
@endsection



