@extends('layout.app')

@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">{{auth()->user()->username}}'s Informations</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="doctor-profile.html">Staff Profile</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="new-patients main_container">
                <div class="row">
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-primary bg-card3">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-book fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Total Documentation</span>
                                        <a href="#"><h3 class="mb-0 text-white">{{$documentCount}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-danger bg-card1">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Entry Documentation</span>
                                        <a href="#"><h3 class="mb-0 text-white">{{$entryDocsCount}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-success bg-card2">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf  fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">In-service Documentation</span>
                                        <a href=""><h3 class="mb-0 text-white">{{$inServiceDocsCount}}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                </div>
                
                
            </div>

            <div class="row">
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex ">
                                <div class="d-flex left-content">
                                   
                                    <div class="media-body">
                                        @if (key_exists('thumbnailphoto',$data[0]))
                                            <img src="data:image/jpeg;base64,{{base64_encode($data[0]['thumbnailphoto'][0])}}" alt="image" class="rounded-circle shadow">
                                        @else
                                        <img alt="image" class="rounded-circle shadow" width="100"
                                        src="{{asset('assets/images/client.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Title</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @if (key_exists('title',$data[0]))
                                                {{ $data[0]['title'][0]}}
                                            @else
                                              <b style="color: red;">Not available</b>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Full Name</b>
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{$data[0]['displayname'][0]}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>E-mail</b>
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{ $data[0]['userprincipalname'][0]}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Staff ID</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                                {{$userData->staff_id}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>SSNIT NO.</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{$userData->ssnit_number}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Age</b>
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{auth()->user()->age($userData->dob)}}
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Marital</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                                {{$userData->marital}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Mobile No.</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @if (count($userData->getContactInformation()) > 0)
                                                {{$userData->getContactInformation()[0]->phone_number}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Ghana Card No.</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{$userData->ghana_card_number}}
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <hr><br>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Personal E-mail</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                                {{$userData->personal_email}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Ghana Card No.</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            {{$userData->ghana_card_number}}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Digital Address</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @if (count($userData->getContactInformation()) > 0)
                                                {{$userData->getContactInformation()[0]->digital_address}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label"><b>Postal Address</b> 
                                            <span class="text-info">:</span>
                                        </label>
                                        <div class="col-lg-6">
                                            @if (count($userData->getContactInformation()) > 0)
                                                {{$userData->getContactInformation()[0]->postal_address}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="doctor-info-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link  active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                                    Personal Information
                                </button>
                            </li>
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                    aria-selected="false">
                                    Other Records
                                </button>
                            </li>
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link" id="documents-tab" data-bs-toggle="tab"
                                    data-bs-target="#documents" type="button" role="tab" aria-controls="documents"
                                    aria-selected="false">
                                    Documentation
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Emergency Contact </h4>
                                        </div>
                                        <div class="card-body">
                                            
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Person Name</label>
                                                            <input disabled type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->name}} @else {{old('person_name')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Relationship</label>
                                                            <select disabled class="form-control form-select" id="relationship" name="relationship" required>
                                                                <option value="">Choose Relationship</option>
                                                                @foreach ($contactRelationshipList as $relationshipItem)
                                                                   <option value="{{$relationshipItem->id}}" @if (count($userData->getEmergencyInformation())) @if ($relationshipItem->id == $userData->getEmergencyInformation()[0]->relationship_id) selected @endif @endif>{{$relationshipItem->name}}</option>
                                                                @endforeach    
                                                            </select>
                                                            @error('relationship')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Phone number</label>
                                                            <input type="text" disabled class="form-control" id="phone_number" placeholder="" name="phone_number" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->phone_number}} @else {{old('phone_number')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" disabled class="form-control" id="email" placeholder="" name="email" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->emal}} @else {{old('email')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label"> Digital Address
                                                            </label>
                                                            <input type="text" disabled class="form-control" id="digital_address" name="digital_address" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->digital_address}} @else {{old('digital_address')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Postal Address</label>
                                                            <input type="text" disabled class="form-control" id="postal_address" name="postal_address" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->postal_address}} @else {{old('postal_address')}} @endif">
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"> Next of Kin Information </h4>
                                    </div>
                                    <div class="card-body">
                                        
                                            <div class="row g-3 align-items-center">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Person Name</label>
                                                        <input disabled type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->name}} @else {{old('person_name')}} @endif">
                                                        @error('person_name')
                                                            <small style="color: red">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Relationship</label>
                                                        <select disabled class="form-control form-select" id="relationship" name="relationship" required>
                                                            <option value="">Choose Relationship</option>
                                                            @foreach ($contactRelationshipList as $relationshipItem)
                                                               <option value="{{$relationshipItem->id}}" @if (count($userData->getnextOfKingInformation())) @if ($relationshipItem->id == $userData->getnextOfKingInformation()[0]->relationship_id) selected @endif @endif>{{$relationshipItem->name}}</option>
                                                            @endforeach    
                                                        </select>
                                                        @error('relationship')
                                                            <small style="color: red">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Phone number</label>
                                                        <input disabled type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->phone_number}} @else {{old('phone_number')}} @endif">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input disabled type="text" class="form-control" id="email" placeholder="" name="email" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->emal}} @else {{old('email')}} @endif">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label"> Digital Address
                                                        </label>
                                                        <input disabled type="text" class="form-control" id="digital_address" name="digital_address" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->digital_address}} @else {{old('digital_address')}} @endif">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Postal Address</label>
                                                        <input disabled type="text" class="form-control" id="postal_address" name="postal_address" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->postal_address}} @else {{old('postal_address')}} @endif">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <a data-bs-toggle='modal' data-bs-target='#addDrugs' id="getPostionAndPromotionBtn">
                                                    <div class="card items widget-4 p-4 mb-4">
                                                        <div class="bootstrap-media">
                                                            <div class="d-flex media">
                                                                <i class="fa fa-certificate fa-lg"></i>
                                                                <div class="media-body">
                                                                    
                                                                    <h4 class="mt-0 mb-1">Position And Promotion Records</h4>
                                                                   
                                                                    <p class="mb-0">{{count($promotionUserList)}} {{Str::plural('record',count($promotionUserList))}}</p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                
                                                    <div class="card items widget-4 p-4 mb-4" style="border-color:green;">
                                                        <div class="bootstrap-media">
                                                            <div class="d-flex media">
                                                                <i class="fa fa-user fa-lg"></i>
                                                                <div class="media-body">
                                                                    
                                                                    <h4 class="mt-0 mb-1">Supervisor's Infomation</h4>
                                                                   
                                                                    <p class="mb-0">@if (count($supervisorData)) Name : {{$supervisorData[0]->name}} @endif</p>
                                                                    <p class="mb-0">@if (count($supervisorData)) Staff ID : {{$supervisorData[0]->staff_id}} @endif</p>
                                                                    <p class="mb-0">@if (count($supervisorData)) Title : {{$supervisorData[0]->getGrade()}} @endif</p>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Job and Qualification Information</h4>
                                            </div>
                                            <div class="card-body">
                                                @if (count($jobQualificationInformation))
                                                <div id="jobQualificationList">
                                                    <table id="table" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Highest Academic Qualification</th>
                                                                <th>Document</th>
                                                                <th>Professional Qualification</th>
                                                                <th>Document</th>
                                                                <th>Job Cadre</th>
                                                                <th>Job Category</th>
                                                                <th>No. of Year at Ministry</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           @foreach ($jobQualificationInformation as $jobQualificationInformationItem)
                                                               <tr>
                                                                  <td>{{$jobQualificationInformationItem->getHighestEducation()}}</td>
                                                                  <td align="center">
                                                                    @if ($jobQualificationInformationItem->getDocumentPath() != "not avaliable")
                                                                        <a id="pdfViewerBtn" data-bs-toggle='modal' data-bs-target='#pdfViews' data-id="{{asset($jobQualificationInformationItem->getDocumentPath())}}#toolbar=0"><i class="fa fa-file-pdf" style="color: red;"></i></a>
                                                                    @endif
                                                                  </td>
                                                                  <td align="center">
                                                                    @if (!empty($jobQualificationInformationItem->profeesional_qualification))
                                                                       {{$jobQualificationInformationItem->profeesional_qualification}} 
                                                                    @else
                                                                        <b>Not available</b>
                                                                    @endif
                                                                </td>
                                                                  <td align="center">@if ($jobQualificationInformationItem->getProfessionalDocumentPath() != "not avaliable")
                                                                    <a id="pdfViewerBtn" data-bs-toggle='modal' data-bs-target='#pdfViews' data-id="{{asset($jobQualificationInformationItem->getProfessionalDocumentPath())}}#toolbar=0"><i class="fa fa-file-pdf" style="color: red;"></i></a>
                                                                 @endif</td>
                                                                  <td align="center">{{$jobQualificationInformationItem->cadre}}</td>
                                                                  <td align="center">{{$jobQualificationInformationItem->category}}</td>
                                                                  <td align="center">{{$jobQualificationInformationItem->number_of_year}} {{Str::plural('year',(int)$jobQualificationInformationItem->number_of_year)}}</td>
                                                               </tr>
                                                           @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>  
                                                @else
                                                  <div id="jobQualificationList"></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Employee Compensation</h4>
                                            </div>
                                            <div class="card-body">
                                                <p align="center" style="display: none; color: limegreen;" id="waitCalFive"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                                <div id="resultFive"></div>
                                                <form id="compensationForm" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Grade</label>
                                                                <select disabled class="form-control form-select" name="current_grade" id="current_grade" >
        
                                                                    <option value="">Grade</option>
    
                                                                    @foreach ($gradeList as $gradeItem)
                                                                    <option value="{{$gradeItem->id}}" @if (count($userData->getEmployeeCompensation()) > 0) @if ($gradeItem->id == $userData->getEmployeeCompensation()[0]->current_grade) selected @endif @endif>{{$gradeItem->name}}</option>
                                                                    @endforeach
                                                                   
                                                                  
                                                                </select>
                                                                <small><b id="current_gradeerror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Salary Level</label>
                                                                <input disabled type="number" class="form-control" id="salary_level" name="salary_level" value="@if (count($userData->getEmployeeCompensation()) > 0){{$userData->getEmployeeCompensation()[0]->salary_level}}@endif">
                                                                <small><b id="salary_levelerror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Salary Point</label>
                                                                <input disabled type="number" name="salary_point" id="salary_point" class="form-control" value="@if (count($userData->getEmployeeCompensation()) > 0){{$userData->getEmployeeCompensation()[0]->salary_point}}@endif">
                                                                <small><b id="salary_pointerror"></b></small>
                                                            </div>
                                                             
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Management Unit</label>
                                                                <select disabled class="form-control form-select" name="management_unit" id="management_unit" >                                                            
    
                                                                    @foreach ($managementUnitLIst as $managementUnitLIstItem)
                                                                    <option value="{{$managementUnitLIstItem->id}}" @if (count($userData->getEmployeeCompensation()) > 0) @if ($managementUnitLIstItem->id == $userData->getEmployeeCompensation()[0]->management_unit) selected @endif @endif>{{$managementUnitLIstItem->management_unit}}</option>
                                                                    @endforeach
                                                                   
                                                                  
                                                                </select>
                                                                <small><b id="management_uniterror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                <div class="card m-t-30">
                                    <div class="row">
                
                                        <div class="col-lg-4">
                                            <div class="card shadow widget-2">
                                                <div class="card-header">
                                                    <h4 class="card-title">Uploaded Doocuments</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="panel-body widget-media main-scroll nicescroll-box">
                                                        <ul class="list-group list-unstyled">
                                                            @foreach ($recentUpload as $iuploadItem)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center media">
                                                                <div class="d-flex">
                                                                    <div class="img-patient">
                                                                        <img src="{{asset('images/file_image.png')}}"
                                                                            class="rounded-circle" alt="people">
                                                                    </div>
                                                                    <div class="media-body">
                                                                        <h4 class="mb-0">{{$iuploadItem->getDocumentClassification()->name}}</h4>
                                                                        <span>{{$iuploadItem->getDocumentType()->description}}</span>
                                                                    </div>
                                                                </div>
                                                                <a id="pdfViewerBtn" data-bs-toggle='modal' data-bs-target='#pdfViews' data-id='{{asset($iuploadItem->document_path)}}#toolbar=0' type="button" class="ms-btn-icon btn-success" name="button">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                            
                                                           
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="card shadow widget1">
                                                <div class="card-header">
                                                    <h4 class="card-title">Statistics</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-12">
                                                            <canvas id="chart3" width="100%" height="20">gf</canvas>
                                                        </div>
                                                        <div class="col-lg-10">
                                                            <ul class="d-flex justify-content-between m-t-30">
                                                                <li class="content-widget text-center">
                                                                    <p class="mb-0 fs-14 text-muted"></p>
                                                                    <h4 class="mb-0 fs-20 text-dark-gray"></h4>
                                                                </li>
                                                                <li class="content-widget text-center">
                                                                    <p class="mb-0 fs-14 text-muted">Entry Documentation</p>
                                                                    <h4 class="mb-0 fs-20 text-dark-gray">{{$entryDocsCount}}</h4>
                                                                </li>
                                                                <li class="content-widget text-center">
                                                                    <p class="mb-0 fs-14 text-muted">In-service Documentation</p>
                                                                    <h4 class="mb-0 fs-20 text-dark-gray">{{$inServiceDocsCount}}</h4>
                                                                </li>
                                                                <li class="content-widget text-center">
                                                                    <p class="mb-0 fs-14 text-muted"></p>
                                                                    <h4 class="mb-0 fs-20 text-dark-gray"></h4>
                                                                </li>
                                                            </ul>
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
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade selectRefresh" id="addDrugs" tabindex="-1" role="dialog"
            aria-labelledby="modal-title-addDrug-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-addDrug-modal"> Positions and Promotion</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p align="center" style="display: none; color: limegreen;" id="waitCalTwoModal"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                <div id="resultsModal"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade selectRefresh" id="pdfViews" tabindex="-1" role="dialog"
    aria-labelledby="modal-title-addDrug-modal">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-addDrug-modal"> PDF VIEW </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="height: 600px;">
                <span id="object"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
        labels: ["Entry", "In-service"],
        datasets: [{
            label: "Documentation",
            backgroundColor: ["rgba(115, 90, 132, 1)", "rgba(231, 100, 18, 1)"],
            data: [{{$entryDocsCount}}, {{$inServiceDocsCount}}]
        }]
    },
    options: {
        legend: {
            display: false,
            position: "left",

        },
        maintainAspectRatio: true,
        title: {
            display: false,
            text: ''
        }
    }
});
</script>


<script>
    $(document).on('click','#getPostionAndPromotionBtn',function(e){
        e.preventDefault();

        $('#resultsModal').empty();
        $('#resultsModal').empty();

        $("#waitCalTwoModal").css("display","block");


        $.ajax({
            type: "POST",
            url: "{{ route('get-user-position-and-promotion')}}",
            data: {
                "_token":"{{ csrf_token() }}",
                'user_id':"{{$userData->id}}"
            },
            success:function(data){

                $("#waitCalTwoModal").css("display","none");
                

                if(data == "empty"){

                    $('#resultsModal').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> No records found</small></p>');
                    $("#resultsModal").hide().fadeIn(2000);
                    // $('html, body').animate({scrollTop:0},"slow");
                    // $("#resultFive").hide().fadeIn(2000);

                }else{

                    $('#resultsModal').html(data);

                    //$('#resultFive').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                    //$("#resultFive").hide().fadeIn(2000);
                    // $('html, body').animate({scrollTop:0},"slow");                        
                    

                }

            }
        });
        



    });
</script>

<script>
    $(document).on('click','#pdfViewerBtn',function(e){
        e.preventDefault();

        let paths = $(this).data('id');

        $('#object').html('<object id="viewerPDF" data="'+paths+'"  type="application/pdf" style="height:100%;width:100%"></object>');

                
    });
</script>
@endsection
