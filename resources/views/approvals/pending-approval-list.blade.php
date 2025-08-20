@extends('layout.app')

@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Pending Approvals</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Documentation</a></li>
                    </ol>
                </div>
            </div>
           

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>SN</th>
                                            <th>Name</th>
                                            <th>Institution</th>
                                            <th>Rank</th>
                                            <th>No. of Document</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($pendingDocumentation as $pendingDocumentationItem)
                                            <tr>
                                                <td align="center">
                                                    <img src="{{asset('images/file_image.png')}}" alt="people" height="30" width="30">
                                                </td>
                                                 <td><b>{{$pendingDocumentationItem->getUserDetails()->serial_number}}</b></td>
                                                <td>{{$pendingDocumentationItem->getUserDetails()->name}}</td>
                                                <td>{{$pendingDocumentationItem->getUserDetails()->getInstitution()->name}}</td>
                                                 <td>{{$pendingDocumentationItem->getUserDetails()->getRank()->name}}</td>
                                                <td><small style="color:red;">{{$pendingDocumentationItem->pendingDocumentAwaiting()}} Pending {{Str::plural('Document',$pendingDocumentationItem->pendingDocumentAwaiting())}}</small></td>
                                                <td><a target="_blank" href="{{route('approve-users-documents',Crypt::encrypt($pendingDocumentationItem->getUserDetails()->id))}}" class="btn btn-success btn-md"><i class="fa fa-list"></i> List Records</a></td>
                                            </tr>
                                        @endforeach
                                        
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

@endsection
