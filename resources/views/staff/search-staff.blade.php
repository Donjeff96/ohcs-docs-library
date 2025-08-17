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
                            @if (session('success'))
                            <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                            @endif
                            <form method="POST" action="{{route('staff-search-process')}}">
                                @csrf
                                <div class="row ">
                                    
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search by First name or Surname or Username" id="username" name="username" value="@session('username') {{session('username')}}@endsession">
                                            @error('username')
                                                <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary w-100 h-56"><i class="fa fa-search"></i> Search</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        
                                    </div>
                                </div>
                            </form>
                            <br><br>
                            @session('data')
                            <div class="table-responsive">
                                <table id="example1" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th># </th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Unit / Division</th>
                                            @if (auth()->user()->user_cat == 1 || auth()->user()->user_cat == 5 || auth()->user()->user_cat == 6  || auth()->user()->user_cat == 7 )
                                             <th></th>
                                            @endif
                                            
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                        @for ($i = 1; $i <= (int)session('count'); $i++)
                                        <tr>
                                            
                                            <td align="center">
                                                @if (key_exists('thumbnailphoto',session('data')[$i-1]))
                                                <img src="data:image/jpeg;base64,{{base64_encode(session('data')[$i-1]['thumbnailphoto'][0])}}" alt="people" height="40" width="40">
                                                
                                                @else
                                                <img src="{{asset('avater.png')}}" alt="people" height="40" width="40">
                                                @endif
                                            </td>
                                            <td><b>{{ session('data')[$i-1]['displayname'][0]}}</b></td>
                                            <td>
                                                @if (key_exists('title',session('data')[$i-1]))
                                                {{ session('data')[$i-1]['title'][0]}}
                                                @else
                                                <b style="color: red;">Not available</b>
                                                @endif
                                            </td>
                                            <td>{{ session('data')[$i-1]['samaccountname'][0]}}</td>
                                            <td>{{ session('data')[$i-1]['userprincipalname'][0]}}</td>
                                            <td>{{auth()->user()->getUsrDivision(session('data')[$i-1]['dn'])}}</td>
                                            @if (auth()->user()->user_cat == 1 || auth()->user()->user_cat == 6  || auth()->user()->user_cat == 7 )
                                                <td>
                                                    <a href="{{route('fetch-user-bio-data',Crypt::encrypt(session('data')[$i-1]['userprincipalname'][0]))}}"> <span class='fas fa-user' style="color:blue;"> Capture</span> </a>
                                                </td>
                                           @endif
                                            
                                            <td>
                                                <a target="_blank" href="{{route('staff-bio-information',Crypt::encrypt(session('data')[$i-1]['userprincipalname'][0]))}}"> <span class='fas fa-eye' style="color:green;"> View</span> </a>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table> 
                            </div>
                            @endsession
                            
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