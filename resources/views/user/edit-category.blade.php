@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add User Category</h4>
                    
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
                            <h4 class="card-title">Forms</h4>
                        </div>
                        <div class="card-body">
                            
                           @if (session('success'))
                              <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                           @endif

                           @if (session('error'))
                              <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('success')}}</span></div>
                           @endif
                            <div class="basic-form">
                                <form action="{{route('edit_user_category-process',$id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="category_name"
                                                    placeholder="Category Name" value="{{$categoryData->name}}" />
                                                    @error('category_name')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="description"
                                                    placeholder="Category Description" value="{{$categoryData->description}}" />
                                                    
                                            </div>
                                        </div>

                                        <div class="col-xl-4">
                                            <div class="form-group">
                                               <select name="status" id="status" class="form-control form-select">
                                                  <option value="Active" @if ($categoryData->status == "Active") selected @endif>Active</option>
                                                  <option value="Inactive" @if ($categoryData->status == "Inactive") selected @endif>Inactive</option>
                                               </select>
                                                   
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary float-end">Update</button>
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