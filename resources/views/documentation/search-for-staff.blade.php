@extends('layout.app')


@section('content')
<div class="content-body ">
    <div class="warper container-fluid">
        <div class="create_invoice main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Document Management</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Search</a>
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
                            <form method="POST" action="{{route('documentation-staff-search-process')}}">
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

                             

                                      @foreach (session('data') as $item)
                                        <tr>
                                            
                                            <td>{{$item->created_at}}</td>
                                            <td><b>{{$item->file_number}}</b></td>
                                            <td>{{$item->name}}</td>
                                            <td> {{$item->grader}}</td>
                                          
                                            <td> {{$item->getInstitution()->name}}</td>
                                            <td>
                                            @if (auth()->user()->user_cat == 6)

                                            <a href="{{route('documentation-fetch-user-bio-data',Crypt::encrypt($item->id))}}"> <span class='fas fa-upload' style="color:green;"></span> </a>
                                                
                                            @else
                                            <a href="{{route('documentation-fetch-user-bio-data',Crypt::encrypt($item->id))}}"> <span class='fas fa-upload' style="color:blue;"></span> </a>
                                            @endif
                                           
                                            
                                        </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table> 
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