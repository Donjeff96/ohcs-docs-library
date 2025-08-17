@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Create User Account</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Add Category</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Account</h4>
                        </div>
                        <div class="card-body">
                            
                           @if (session('success'))
                              <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                           @endif

                           @if (session('error'))
                              <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                           @endif
                            <div class="basic-form">
                                <form action="{{route('create-account-process')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>User's Full Name</p>
                                                <input type="text" class="form-control" name="full_name"
                                                    placeholder="Full Name" value="{{old('full_name')}}" />
                                                    @error('full_name')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Valid E-mail</p>
                                                <input type="text" class="form-control" name="email"
                                                    placeholder="E-mail" value="{{ old('email')}}" />
                                                     @error('email')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>User Category</p>
                                               <select name="user_category" id="user_category" class="form-control form-select">
                                                  <option value="">-- SELECT CATEGORY --</option>
                                                  @foreach ($userCategory as $item)
                                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                  @endforeach
                                                 
                                               </select>
                                                @error('user_category')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                       <div class="col-xl-4">
                                            <div class="form-group">
                                                 <p> Grade</p>
                                               <select name="user_grade" id="user_grade" class="form-control form-select">
                                                  <option value="">-- SELECT GRADE --</option>
                                                  @foreach ($gradesList as $item)
                                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                  @endforeach
                                                 
                                               </select>
                                                @error('user_grade')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                 <p> Profile Picture</p>
                                                <input type="file" class="form-control" name="file" accept=".png,.jpg"
                                                    placeholder="Picture" value="{{ old('file')}}" />
                                                     @error('file')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>
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
                                                <p>Confirmation Password</p>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    placeholder="Confirm Password" value="" />
                                                     @error('password_confirmation')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary float-end">Save</button>
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