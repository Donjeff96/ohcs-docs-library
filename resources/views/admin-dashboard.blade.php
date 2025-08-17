@extends('layout.app')

@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-lg-9 p-md-0">
                <h4 class="text-primary">Welcome <span class="names">{{auth()->user()->username}}</span></h4>
                <p class="mb-0">This is the Ministry of Finance's Human Capital Management Information System</p>
                
            </div>
            <br><br><br>
            <div class="new-patients main_container">
                <div class="row">
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-success bg-card3">
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
                        <div class="widget card card-primary bg-card1">
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
                    <div class="col-sm-6 col-xl-3 col-lg-6">
                        <div class="widget card card-danger bg-card2">
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
                        <div class="widget card card-info bg-card2">
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
                   
                    
                </div>
                
                
            </div>

            <div class="row">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if (auth()->user()->photoUrl == null)
                                <img src="{{asset('avater.png')}}" alt="Admin" class="rounded-circle p-1" width="110">
                                    
                                @else
                                <img src="data:image/jpeg;base64,{{auth()->user()->photoUrl}}" alt="Admin" class="rounded-circle p-1" width="110">   
                                @endif
                               
                                <div class="mt-3">
                                    <h4>{{auth()->user()->name}}</h4>
                                    <p class="text-secondary mb-1">{{auth()->user()->category}}</p>
                                    <p class="text-muted font-size-sm">{{auth()->user()->email}}</p>
                                    <button class="btn btn-success">{{auth()->user()->userCategory()}}</button>
                                    <button class="btn btn-outline-success">{{auth()->user()->status}}</button>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                @if (auth()->user()->title != null)
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <span>Title</span>
                                    <span class="text-secondary">{{auth()->user()->title}}</span>
                                </li>
                                @endif
                                @if (auth()->user()->staff_id != null)
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <span>Staff ID</span>
                                    <span class="text-secondary">{{auth()->user()->staff_id}}</span>
                                </li>
                                @endif
                                @if (auth()->user()->ghana_card_number != null)
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <span>Ghana Card</span>
                                    <span class="text-secondary">{{auth()->user()->ghana_card_number}}</span>
                                </li>
                                @endif
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card shadow widget-2">
                        <div class="card-header">
                            <h4 class="card-title">Divisions</h4>

                            <a href="">All</a>
                        </div>
                        <div class="card-body">
                            <div class="panel-body widget-media main-scroll nicescroll-box">
                                <ul class="list-group list-unstyled">
                                    
                                    

                                    <table id="table" class=" table">
                                        <thead>
                                            <tr>
                                                <th>Division</th>
                                                <th>Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $countDiv = 0
                                            @endphp
                                            @foreach ($divisionList as $divisionListItem)
                                            @if ($countDiv != 10)
                                            @if ($divisionListItem->staffCount() != 0)
                                            <tr>
                                                <td>{{$divisionListItem->name}}</td>
                                                <td align="center"><a href="{{route('dashboard-list-staff',Crypt::encrypt($divisionListItem->getDivisionID()))}}">{{$divisionListItem->staffCount()}}</a></td>
                                            </tr> 
                                            @php
                                            $countDiv++;
                                        @endphp
                                        @endif 
                                            @endif
                                            
                                                
                                              
                                            @endforeach
                                        </tbody>
                                    </table>
                                 
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-sm-6 col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-between">
                                        <div class="media-body">
                                            <p class="text-primary mb-0 fs-14">Senior</p>
                                            <h4 class="mb-0 fs-20 text-dark-gray"><a style="color: black;'" href="{{route('dashboard-list-staff','Senior')}}">{{$job_qualification_informationtype->where('category','Senior')->get()->count()}}</a></h4>
                                        </div>
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-between">
                                        <div class="media-body">
                                            <p class="text-warning mb-0 fs-14">Junior</p>
                                           
                                            <h4 class="mb-0 fs-20 text-dark-gray"><a style="color: black;'" href="{{route('dashboard-list-staff','Junior')}}">{{$job_qualification_informationtype->where('category','Junior')->get()->count()}}</a></h4>
                                        </div>
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-between">
                                        <div class="media-body">
                                            <p class="text-success mb-0 fs-14">Professional</p>
                                            <h4 class="mb-0 fs-20 text-dark-gray"><a style="color: black;'" href="{{route('dashboard-list-staff','Professional')}}">{{$job_qualification_informationtype->where('cadre','Professional')->get()->count()}}</a></h4>
                                        </div>
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xl-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="media d-flex justify-content-between">
                                        <div class="media-body">
                                            <p class="text-danger mb-0 fs-14">Sub Professional</p>
                                            
                                            <h4 class="mb-0 fs-20 text-dark-gray"><a style="color: black;'" href="{{route('dashboard-list-staff','Sub Professional')}}">{{$job_qualification_informationtype->where('cadre','Sub Professional')->get()->count()}}</a></h4>
                                        </div>
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="row">
                
                @if (auth()->user()->user_cat == 1 || auth()->user()->user_cat == 6)
                <div class="col-lg-4">
                    <div class="card shadow widget-2">
                        <div class="card-header">
                            <h4 class="card-title">Pending {{Str::plural('Approval',count($pendingDocumentation))}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="panel-body widget-media main-scroll nicescroll-box">
                                <ul class="list-group list-unstyled">

                                    @foreach ($pendingDocumentation as $pendingDocumentationItem)
                                    <li
                                    class="list-group-item d-flex justify-content-between align-items-center media">
                                    <div class="d-flex">
                                        <div class="img-patient">
                                            

                                        @if (!empty($pendingDocumentationItem->getUserDetails()->photoUrl))
                                       <img src="data:image/jpeg;base64,{{$pendingDocumentationItem->getUserDetails()->photoUrl}}" alt="people" class="rounded-circle">
                                        @else
                                        <img src="{{asset('avater.png')}}" alt="people" class="rounded-circle">
                                        @endif
                                        </div>
                                        <div class="media-body">
                                            <h4 class="mb-0">{{$pendingDocumentationItem->getUserDetails()->name}}</h4>
                                            <span>{{$pendingDocumentationItem->getUserDetails()->title}}</span>
                                            <p style="color:green;">{{$pendingDocumentationItem->pendingDocumentAwaiting()}} Pending {{Str::plural('Document',$pendingDocumentationItem->pendingDocumentAwaiting())}}</p>
                                        </div>
                                    </div>
                                    <a  href="{{route('approve-users-documents',Crypt::encrypt($pendingDocumentationItem->getUserDetails()->id))}}" type="button" class="ms-btn-icon btn-success" name="button">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    
                @endif
                
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart8"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div> 

@endsection


@section('java_script')

<script src="{{asset('assets/plugins/chart/chart/Chart.min.js')}}"></script>


<script>
      
new Chart(document.getElementById("chart3"), {
    type: 'doughnut',
    data: {
        labels: <?php echo $divisionArr ?>,
        datasets: [{
            label: "Divisions",
            backgroundColor: ["rgba(115, 90, 132, 1)", "rgba(231, 100, 18, 1)", "rgba(155, 195, 17, 1)", "rgba(78, 152, 217, 1)","rgba(39, 234, 245, 0.8)","rgba(122, 150, 152, 0.8)","rgba(17, 159, 34, 0.8)","rgba(181, 59, 47, 0.8)","rgba(255, 173, 164, 0.8)","rgba(4, 4, 4, 0.8)","rgba(17, 48, 159, 0.8)"],
            data: <?php echo $divisionCountArr ?>
        }]
    },
    options: {
        legend: {
            display: true,
            position: "left",

        },
        maintainAspectRatio: false,
        title: {
            display: false,
            text: 'Divisions'
        }
    }
});
</script>
@endsection