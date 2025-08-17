@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Update Account Information</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Assign Role</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="widget-media list-doctors best-doctor">
                        <div class="timeline row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="timeline-panel card p-4 mb-4">
                                    <div class="media">
                                        
                                        @if (!empty($userData->photoUrl))
                                        <img alt="image" src="{{asset($userData->photoUrl)}}">
                                        @else
                                        <img alt="image" src="{{asset('avater.png')}}">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <a href="#">
                                            <h4 class="mb-2">{{$userData->name}}</h4>
                                        </a>
                                        <p class="mb-2">{{$userData->email}}</p>
                                        <p class="mb-2">{{$userData->userCategory()}}</p>
                                    </div>
                                    {{-- <div class="btn-group-style-1">
                                        <div class="btn-content">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <div class="form-content">
                                                    <a href="#">
                                                        <span class="ml-2">View Profile</span>
                                                    </a>
                                                    <a href="#">
                                                        <span class="ml-2">Edit</span>
                                                    </a>
                                                    <a href="#">
                                                        <span class="ml-2">Delete </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Set Organizational Role</h4>
                        </div>
                        <div class="card-body">
                            
                           @if (session('success'))
                              <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                           @endif

                           @if (session('error'))
                              <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                           @endif
                          
                            <div class="basic-form">
                                <form action="{{route('reassign_user_category-process',$id)}}" method="POST">
                                    @csrf
                                   
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Grade</p>
                                                <select name="grade" id="grade" class="form-control form-select">
                                                    <option value="">-- SELECT GRADE  --</option>
                                                    @foreach ($getDivision as $divisionItem)
                                                       <option value="{{$divisionItem->id}}" @if ($userData->category == $divisionItem->id) selected @endif >{{$divisionItem->name}}</option>
                                                    @endforeach
                                                 </select>
                                                    @error('grade')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>User Category</p>
                                                <select name="category" id="category" class="form-control form-select">
                                                    <option value="" >-- SELECT USER CATEGORY --</option>
                                                    @foreach ($userCategory as $category)
                                                       <option value="{{$category->id}}" @if ($userData->user_cat == $category->id) selected @endif >{{$category->name}}</option>
                                                    @endforeach
                                                 </select>
                                                    @error('category')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            
                                                <button style="margin-top: 50px;" type="submit"
                                                    class="btn btn-success float-start">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Reset Password</h4>
                        </div>
                        <div class="card-body">
                            
                           {{-- @if (session('success'))
                              <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                           @endif

                           @if (session('error'))
                              <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                           @endif --}}
                          
                            <div class="basic-form">
                                <form action="{{route('reassign_user_unit-process',$id)}}" method="POST">
                                    @csrf
                                   
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Password</p>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Password" value="" />
                                                    @error('password')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Confirm Password</p>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Confirm Password" value="" />
                                                    @error('password_confirmation')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            
                                                <button style="margin-top: 50px;" type="submit"
                                                    class="btn btn-primary float-start">Update Password</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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