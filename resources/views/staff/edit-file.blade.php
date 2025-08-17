@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Create File</h4>
                    
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
                            <h4 class="card-title">File Details</h4>
                        </div>
                        <div class="card-body">
                            
                           @if (session('success'))
                              <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                           @endif

                           @if (session('error'))
                              <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                           @endif
                            <div class="basic-form">
                                <form action="{{route('edit-file-information-process',$id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Serial Number</p>
                                                <input disabled type="text" class="form-control" name="serial_number"
                                                    placeholder="Serial Number"  value="{{ $data->serial_number }}" />
                                                    @error('serial_number')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>File Number</p>
                                                <input disabled type="text" class="form-control" name="filenumber"
                                                    placeholder="File Number"  value="{{ $data->file_number }}"/>
                                                     @error('filenumber')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                         <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Personel Name</p>
                                                <input type="text" class="form-control" name="full_name"
                                                    value="{{ $data->name}}" />
                                                     @error('full_name')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Rank</p>
                                               <select name="rank" id="rank" class="form-control form-select">
                                                  <option value="">-- SELECT RANK --</option>
                                                  @foreach ($gradesList as $item)
                                                       <option value="{{ $item->id }}" @if ($item->id == $data->rank)
                                                           selected
                                                       @endif>{{ $item->name }}</option>
                                                  @endforeach
                                                 
                                               </select>
                                                @error('rank')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                       <div class="col-xl-4">
                                            <div class="form-group">
                                                 <p> Institution</p>
                                               <select name="institution" id="institution" class="form-control form-select">
                                                  <option value="">-- SELECT INSTITUTION --</option>
                                                  @foreach ($inistList as $item)
                                                       <option value="{{ $item->id }}" @if ($item->id == $data->institution)
                                                           selected
                                                       @endif>{{ $item->name }}</option>
                                                  @endforeach
                                                 
                                               </select>
                                                @error('institution')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                 <p> Gender</p>
                                               <select name="gender" id="gender" class="form-control form-select">
                                                  <option value="">-- SELECT GENDER --</option>
                                                  <option value="Male" @if ("Male" == $data->grader)
                                                           selected
                                                       @endif>Male</option>
                                                  <option value="Female" @if ("Female" == $data->grader)
                                                           selected
                                                       @endif>Female</option>
                                                 
                                               </select>
                                                @error('gender')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Date Of Hire</p>
                                                <input type="date" class="form-control" name="date_of_hire"
                                                     value="{{ $data->date_of_hire }}" />
                                                     @error('date_of_hire')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <p>Date Of Retirement</p>
                                                <input type="date" class="form-control" name="date_of_retirement"
                                                     value="{{ $data->date_of_retirement }}" />
                                                     @error('date_of_retirement')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary float-end">Create</button>
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