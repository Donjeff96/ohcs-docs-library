@extends('layout.app')

@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-lg-9 p-md-0">
                <h4 class="text-primary">General Report</span></h4>
            </div>
            <br><br><br>
            <div class="new-patients main_container">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-primary bg-card3">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-users fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Total {{Str::plural('Staff',$totalStaff)}}</span>
                                        <h3 class="mb-0 text-white"><a target="_blank" style="color: white;'" href="{{route('dashboard-list-staff','all-staff')}}">{{$totalStaff}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-info bg-card2">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-male  fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">{{Str::plural('Male',$maleCount)}}</span>
                                        <h3 class="mb-0 text-white"><a target="_blank" style="color: white;'" href="{{route('dashboard-list-staff','Male')}}">{{$maleCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-danger bg-card2">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-female  fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">{{Str::plural('Female',$femaleCount)}}</span>
                                        
                                        <h3 class="mb-0 text-white"><a target="_blank" style="color: white;'" href="{{route('dashboard-list-staff','Female')}}">{{$femaleCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-success bg-card1">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Uploaded {{Str::plural('Document',$documentCount)}}</span>
                                        <h3 class="mb-0 text-white"><a target="_blank" style="color: white;'" href="#">{{$documentCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div>
                
                
            </div>
        </div>


        <div class="row">
                
            <div class="col-lg-5">
                <div class="card shadow widget-2">
                    <div class="card-header">
                        <h4 class="card-title">Grades</h4>
                    </div>
                    <div class="card-body">
                        <div class="panel-body widget-media main-scroll nicescroll-box">
                            <ul class="list-group list-unstyled">
                                
                                <table id="example1" class=" table">
                                    <thead>
                                        <tr>
                                            <th>Grade</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($gradeList as $gradeListItem)
                                           <tr>
                                             <td>{{$gradeListItem->name}}</td>
                                             <td ><b><a style="color: blue;" target="_blank" href="{{route('general-report-list-grade-staff',Crypt::encrypt($gradeListItem->id))}}">{{$gradeListItem->mainStaffCount()}}</a></b></td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                             
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow widget-2">
                    <div class="card-header">
                        <h4 class="card-title">Divisions</h4>
                    </div>
                    <div class="card-body">
                        <div class="panel-body widget-media main-scroll nicescroll-box">
                            <ul class="list-group list-unstyled">
                                
                                

                                <table id="table" class=" table">
                                    <thead>
                                        <tr>
                                            <th>Divisions</th>
                                            <th>Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($divisionList as $divisionListItem)
                                            <tr>
                                                <td>{{$divisionListItem->name}}</td>
                                                <td align="center"><a style="color: blue;" href="{{route('dashboard-list-staff',Crypt::encrypt($divisionListItem->getDivisionID()))}}">{{$divisionListItem->staffCount()}}</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             
                            </ul>
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