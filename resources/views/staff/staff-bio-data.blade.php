@extends('layout.app')


@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Staff Biodata</h4>
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between doctor-info-details">
                                <div class="d-flex left-content">
                                    <div class="media align-self-start">
                                        

                                            @if (key_exists('thumbnailphoto',$data[0]))
                                            <img src="data:image/jpeg;base64,{{base64_encode($data[0]['thumbnailphoto'][0])}}" alt="image" class="rounded-circle shadow" width="90">
                                            
                                            @else
                                            <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{asset('assets/images/client.jpg')}}">
                                            @endif
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2">{{$data[0]['displayname'][0]}}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">{{ $data[0]['userprincipalname'][0]}}</p>
                                            <p class="mb-md-2 mb-sm-4 mb-2">@if (key_exists('title',$data[0]))
                                                {{ $data[0]['title'][0]}}
                                                @else
                                                <b style="color: red;">Not available</b>
                                                @endif</p>
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
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                    aria-selected="false">Position and Promotion</button>
                            </li>
                            <li class="nav-item col-md-4" role="presentation">
                                <button class="nav-link" id="job-tab" data-bs-toggle="tab"
                                    data-bs-target="#job" type="button" role="tab" aria-controls="job"
                                    aria-selected="false">Job and Qualification Information</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <br>
                            @if (session('success'))
                            <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('error')}}</span></div>
                            @endif
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        
                                        <br><br>
                                        <form>
                                            <div class="row">

                                                <div class="col-xl-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Title 
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            @if (key_exists('title',$data[0]))
                                                                <b>{{ $data[0]['title'][0]}}</b>
                                                            @else
                                                              <b style="color: red;">Not available</b>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Name
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <b>{{$data[0]['displayname'][0]}}</b>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Username
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <b>{{ $data[0]['samaccountname'][0]}}</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-3">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">E-mail
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <b>{{ $data[0]['userprincipalname'][0]}}</b>
                                                        </div>
                                                    </div>
                                                </div>


                                                 
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                                <div class="row m-t-30 m-l-0 m-r-0">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Personal Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{route('update-staff-information-bio',Crypt::encrypt($userData->id))}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group row widget-3 text-center">
                                 

                                                            @if (key_exists('thumbnailphoto',$data[0]))
                                                            
                                                            <div class="preview">
                                                                <img src="data:image/jpeg;base64,{{base64_encode($data[0]['thumbnailphoto'][0])}}" src="#" alt="img" height="200" width="200">
                                                            </div>

                                                            @else

                                                            <div class="preview">
                                                                <img id="file-ip-1-preview" src="#" alt="img">
                                                            </div>

                                                            @endif
                                                                    <b class="text-center">{{$userData->name}}</b>  
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group row">
                                                                <div class="col-lg-12">
                                                                    <label class="form-label">Staff ID <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"  id="staff_id" name="staff_id" value="@if (!empty($userData->staff_id)) {{$userData->staff_id}}  @endif" >
                                                                    @error('staff_id')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-12">
                                                                    <label class="form-label">Ghana Card Number <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" id="ghana_card_number" name="ghana_card_number" value="@if (!empty($userData->ghana_card_number)) {{$userData->ghana_card_number}} @endif" >
                                                                    @error('ghana_card_number')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label">Surname <span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                     value="@if(!empty($userData->surname)){{$userData->surname}}@endif" name="surname" id="surname" >
                                                                    @error('surname')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label">Other Names</label>
                                                                <input type="text" class="form-control"
                                                                     value="@if(!empty($userData->othernames)){{$userData->othernames}}@endif" name="othernames" id="othernames" >
                                                                    @error('othernames')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                            </div>
                                                            
                                                            
                                                            <div class="form-group">
                                                                <label class="form-label">Marital Status <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="marital_status" id="marital_status" >
                                                                    <option value="">Marital Status</option>
                                                                    <option value="Single" @if ($userData->marital == "Single") selected @endif>Single</option>
                                                                    <option value="Married" @if ($userData->marital == "Married") selected @endif>Married</option>
                                                                    <option value="Divorced" @if ($userData->marital == "Divorced") selected @endif>Divorced</option>
                                                                    
                                                                </select>
                                                                @error('marital_status')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="form-label">Current Grade <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="current_grade" id="current_grade" >
                                                                    <option value="">-- SELECT GRADE --</option>
                                                                    @foreach ($gradeList as $gradeListItem)
                                                                       <option value="{{$gradeListItem->id}}" @if ($gradeListItem->id == $userData->current_grade) selected @endif>{{$gradeListItem->name}}</option> 
                                                                    @endforeach
                                                                </select>
                                                                @error('current_grade')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group row">
                                                                <div class="col-lg-12">
                                                                    <label class="form-label">SSNIT Number <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control" id="ssnit_number" name="ssnit_number" value="@if(!empty($userData->ssnit_number)){{$userData->ssnit_number}}@endif" >
                                                                    @error('ssnit_number')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Title <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" id="ptitle" name="ptitle" >
                                                                    <option value="">Choose A Title</option>
                                                                    <option value="Mr." @if ($userData->ptitle == "Mr.") selected @endif>Mr.</option>
                                                                    <option value="Mrs." @if ($userData->ptitle == "Mrs.") selected @endif>Mrs.</option>
                                                                    <option value="Miss." @if ($userData->ptitle == "Miss.") selected @endif>Miss.</option>
                                                                    <option value="Dr." @if ($userData->ptitle == "Dr.") selected @endif>Dr.</option>
                                                                    <option value="Prof." @if ($userData->ptitle == "Prof.") selected @endif>Prof.</option>
                                                                    
                                                                </select>
                                                                @error('ptitle')
                                                                     <small style="color: red">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">First Name <span style="color:red;">*</span></label>
                                                                <input type="text" class="form-control"
                                                                     value="@if (!empty($userData->firstname)){{$userData->firstname}}@endif" name="firstname" id="firstname" >
                                                                    @error('firstname')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Gender <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" id="gender" name="gender" >
                                                                    <option value="">Choose A Gnder</option>
                                                                    <option value="Male" @if ($userData->gender == "Male") selected @endif>Male</option>
                                                                    <option value="Female" @if ($userData->gender == "Female") selected @endif>Female</option>
                                                                    
                                                                </select>
                                                                @error('gender')
                                                                     <small style="color: red">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label">Date of Birth <span style="color:red;">*</span></label>
                                                                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="@if(!empty($userData->dob)){{$userData->dob}}@endif" >
                                                                @error('date_of_birth')
                                                                     <small style="color: red">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                            {{-- <div class="form-group">
                                                                <label class="form-label">Personal Email</label>
                                                                <input type="text" class="form-control"  name="personal_email" id="personal_email" value="@if(!empty($userData->personal_email)){{$userData->personal_email}}@endif">
                                                                @error('personal_email')
                                                                     <small style="color: red">{{$message}}</small>
                                                                @enderror
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                    <div class="form-group text-right">
                                                        <button type="submit" class="btn btn-primary float-end ">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Contact Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                <form method="POST" action="{{route('update-contact-information-bio',Crypt::encrypt($userData->id))}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Corporate E-mail <span style="color:red;">*</span></label>
                                                                <input type="email" class="form-control"
                                                                    placeholder="Email" value="@if(!empty($userData->email)){{$userData->email}}@endif" name="corporate_email" id="corporate_email" readonly>
                                                                    @error('corporate_email')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Phone number <span style="color:red;">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                    
                                                                    placeholder=""  name="phone_number" id="phone_number" required value="@if (count($userData->getContactInformation())) {{$userData->getContactInformation()[0]->phone_number}} @else {{old('phone_number')}} @endif">
                                                                <div class="col-lg-12">
                                                                </div>
                                                                @error('phone_number')
                                                                    <small style="color: red">{{$message}}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Personal Email <span style="color:red;">*</span></label>
                                                                    <input type="email" class="form-control"
                                                                    placeholder=""  name="email" id="email" value="@if (count($userData->getContactInformation())) {{$userData->getContactInformation()[0]->emal}} @else {{old('email')}} @endif" required>
                                                                    @error('email')
                                                                        <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label"> Digital Address
                                                                </label>
                                                                <input type="text" class="form-control" id="digital_address" name="digital_address" value="@if (count($userData->getContactInformation())) {{$userData->getContactInformation()[0]->digital_address}} @else {{old('digital_address')}} @endif">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Postal Address</label>
                                                                <input type="text" class="form-control" id="postal_address" name="postal_address" value="@if (count($userData->getContactInformation())) {{$userData->getContactInformation()[0]->postal_address}} @else {{old('postal_address')}} @endif">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <button type="submit"
                                                            class="btn btn-primary float-end ">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Emergency Contact </h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{route('update-emergency-information-bio',Crypt::encrypt($userData->id))}}">
                                                @csrf
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Person Name <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->name}} @else {{old('person_name')}} @endif">
                                                            @error('person_name')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Relationship <span style="color:red;">*</span></label>
                                                            <select class="form-control form-select" id="relationship" name="relationship" required>
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
                                                            <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->phone_number}} @else {{old('phone_number')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->emal}} @else {{old('email')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label"> Digital Address
                                                            </label>
                                                            <input type="text" class="form-control" id="digital_address" name="digital_address" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->digital_address}} @else {{old('digital_address')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Postal Address</label>
                                                            <input type="text" class="form-control" id="postal_address" name="postal_address" value="@if (count($userData->getEmergencyInformation())) {{$userData->getEmergencyInformation()[0]->postal_address}} @else {{old('postal_address')}} @endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-end">
                                                    Update</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Next of Kin Information </h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{route('update-nextofking-information-bio',Crypt::encrypt($userData->id))}}">
                                                @csrf
                                                <div class="row g-3 align-items-center">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Person Name <span style="color:red;">*</span></label>
                                                            <input type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="@if(count($userData->getnextOfKingInformation())){{$userData->getnextOfKingInformation()[0]->name}}@else{{old('person_name')}}@endif">
                                                            @error('person_name')
                                                                <small style="color: red">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Relationship <span style="color:red;">*</span></label>
                                                            <select class="form-control form-select" id="relationship" name="relationship" required>
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
                                                            <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->phone_number}} @else {{old('phone_number')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->emal}} @else {{old('email')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label"> Digital Address
                                                            </label>
                                                            <input type="text" class="form-control" id="digital_address" name="digital_address" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->digital_address}} @else {{old('digital_address')}} @endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Postal Address</label>
                                                            <input type="text" class="form-control" id="postal_address" name="postal_address" value="@if (count($userData->getnextOfKingInformation())) {{$userData->getnextOfKingInformation()[0]->postal_address}} @else {{old('postal_address')}} @endif">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary float-end">
                                                    Update</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="col-md-8 col-lg-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Position and Promotion</h4>
                                            </div>
                                            <div class="card-body">
                                                <form id="postingForms" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Promotion Type <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="position_promotion" id="position_promotion" >
        
                                                                    <option value="">Promotion Type</option>
                                                                    @foreach ($positionAndPromotionTypes as $positionAndPromotionTypesItem)
                                                                      <option value="{{$positionAndPromotionTypesItem->id}}">{{$positionAndPromotionTypesItem->name}}</option>
                                                                    @endforeach
                                                                  
                                                                </select>
                                                                <small><b id="position_promotionerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Grade <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="grade" id="grade" >
        
                                                                    <option value="">Grade</option>

                                                                    @foreach ($gradeList as $gradeItem)
                                                                    <option value="{{$gradeItem->id}}">{{$gradeItem->name}}</option>
                                                                    @endforeach
                                                                   
                                                                  
                                                                </select>
                                                                <small><b id="gradeerror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Date <span style="color:red;">*</span></label>
                                                                <input type="date" name="reference_date" id="reference_date" class="form-control">
                                                                <small><b id="reference_dateerror"></b></small>
                                                            </div>
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <a id="submit" class="btn btn-primary float-end ">Add</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <p align="center" style="display: none; color: limegreen;" id="waitCalTwo"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                <div id="results"></div>

                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <div class="card-header">
                                            
                                            <h4 class="card-title">Position and Promotion Records</h4>
                                        </div>
                                        <br><br>
                                        @if (count($promotionUserList))

                                            <div id="recordList">
                                                <table id="example1" class="display nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Type</th>
                                                            <th>Grade</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($promotionUserList as $promotionUserListItem)
                                                            <tr>
                                                                <td style="color: green;" align="center">{{date('jS F Y',strtotime($promotionUserListItem->date))}}</td>
                                                                <td>{{$promotionUserListItem->getTypeName()}}</td>
                                                                <td>{{$promotionUserListItem->getGrade()}}</td>
                                                                <td><a id="postingModalUpdate" data-bs-toggle='modal' data-bs-target='#addDrugs' data-id="{{$promotionUserListItem->id}}"><i class="fa fa-edit" style="color:red;"></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>   
                                            @else
                                            <div id="recordList"></div>   
                                        @endif
                                        
                                    </div>
                                </div>

                                <p align="center" style="display: none; color: limegreen;" id="waitCalThree"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                <div id="resultsThree"></div>

                                <div class="row">
                                    <div class="col-md-8 col-lg-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Supervisor's Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <form id="supervisorForms" method="POST">
        
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Full name <span style="color:red;">*</span></label>
                                                                <input type="text" name="supervisors_name" id="supervisors_name" class="form-control">
                                                                <small><b id="supervisors_nameerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-5">
                                                            <div class="form-group">
                                                                <label class="form-label">Grade <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="supervisors_grade" id="supervisors_grade" >
        
                                                                    <option value="">Grade</option>

                                                                    @foreach ($gradeList as $gradeItem)
                                                                    <option value="{{$gradeItem->id}}">{{$gradeItem->name}}</option>
                                                                    @endforeach
                                                                   
                                                                  
                                                                </select>
                                                                <small><b id="supervisors_gradeerror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Staff ID <span style="color:red;">*</span></label>
                                                                <input type="text" name="supervisors_staff_id" id="supervisors_staff_id" class="form-control">
                                                                <small><b id="supervisors_staff_iderror"></b></small>
                                                            </div>
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-right">
                                                        <a id="addSuper" class="btn btn-primary float-end ">Add</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if (count($supervisorData))
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Supervisor</h4>
                                            </div>
                                            <div class="card-body">
                                                <div id="recordListThree">
                                                    <div class="d-flex justify-content-between doctor-info-details">
                                                        <div class="d-flex left-content">
                                                            <div class="media align-self-start">
                                                                <img alt="image" class="rounded-circle shadow" width="90"
                                                                src="{{asset('assets/images/profile_avater.png')}}">
                                                                <div class="pulse-css"></div>
                                                            </div>
                                                            <div class="media-body">
                                                                <h2 class="mb-2">{{$supervisorData[0]->name}}</h2>
                                                                <p class="mb-md-2 mb-sm-4 mb-2">{{ $supervisorData[0]->getGrade()}}</p>
                                                                    <p class="mb-md-2 mb-sm-4 mb-2">{{ $supervisorData[0]->staff_id}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                    @else
                                    <div class="col-md-4 col-lg-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Supervisor</h4>
                                            </div>
                                            <div class="card-body">

                                                <div class="d-flex justify-content-between doctor-info-details">
                                                    <div class="d-flex left-content">

                                                        <div id="recordListThree"></div>
                                                        {{-- <div class="media align-self-start">
                                                            <img alt="image" class="rounded-circle shadow" width="90"
                                                            src="{{asset('assets/images/client.jpg')}}">
                                                            <div class="pulse-css"></div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h2 class="mb-2">{{$supervisorData[0]->name}}</h2>
                                                            <p class="mb-md-2 mb-sm-4 mb-2">{{ $supervisorData[0]->getGrade()}}</p>
                                                                <p class="mb-md-2 mb-sm-4 mb-2">{{ $supervisorData[0]->staff_id}}</p>
                                                        </div> --}}
                                                    </div>
                                                </div>


                                            </div>
                                        </div> 
                                    </div>
                                        
                                    @endif
                                   
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade" id="job" role="tabpanel" aria-labelledby="job-tab">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Job and Qualification Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <form id="acadeForms">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Highest Academic Qualification <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="highest_academic_qualification" id="highest_academic_qualification">
        
                                                                    <option value="">Select Academic Qualification</option>
                                                                    @foreach ($hQualifiaction as $hQualifiactionItem)
                                                                      <option value="{{$hQualifiactionItem->id}}">{{$hQualifiactionItem->name}}</option>
                                                                    @endforeach
                                                                  
                                                                </select>
                                                                <small><b id="highest_academic_qualificationerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Document Type <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="document_type" id="document_type">
        
                                                                    <option value="">Select Document Type</option>
                                                                    @foreach ($documentType as $documentTypeItem)
                                                                      <option value="{{$documentTypeItem->id}}">{{$documentTypeItem->description}}</option>
                                                                    @endforeach
                                                                  
                                                                </select>
                                                                <small><b id="document_typeerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Upload Academic Certificate <span style="color:red;">*</span></label>
                                                                <br><br>
                                                                <input type="file"  name="academic_document" id="academic_document" accept=".pdf">
                                                                <small><b id="academic_documenterror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Professional Qualification</label>
                                                                <input type="text" class="form-control" name="professional_qualification" id="professional_qualification">
                                                                <small><b id="professional_qualificationerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Document Type</label>
                                                                <select class="form-control form-select" name="document_type_professional" id="document_type_professional">
        
                                                                    <option value="">Select Document Type</option>
                                                                    @foreach ($documentType as $documentTypeItem)
                                                                      <option value="{{$documentTypeItem->id}}">{{$documentTypeItem->description}}</option>
                                                                    @endforeach
                                                                  
                                                                </select>
                                                                <small><b id="document_type_professionalerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Upload Professional Certificate</label>
                                                                <br><br>
                                                                <input type="file"  name="professional_document" id="professional_document" accept=".pdf">
                                                                <small><b id="professional_documenterror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Job Cadre <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="job_cadre" id="job_cadre">
        
                                                                    <option value="">Select Job Cadre</option>
                                                                    <option value="Professional">Professional</option>
                                                                    <option value="Sub Professional">Sub Professional</option>
                                                                </select>
                                                                <small><b id="job_cadreerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Job Category <span style="color:red;">*</span></label>
                                                                <select class="form-control form-select" name="job_category" id="job_category">
        
                                                                    <option value="">Select Job Category</option>
                                                                    <option value="Senior">Senior</option>
                                                                    <option value="Junior">Junior</option>
                                                                   
                                                                  
                                                                </select>
                                                                <small><b id="job_categoryerror"></b></small>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4">
                                                            <div class="form-group">
                                                                <label class="form-label">Number Of Year at Ministry <span style="color:red;">*</span></label>
                                                                
                                                                <input class="form-control" type="number"  name="number_of_years" id="number_of_years" accept=".pdf">
                                                                <small><b id="number_of_yearserror"></b></small>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group text-right">
                                                        <a id="submitDocs" class="btn btn-primary float-end ">Add</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <p align="center" style="display: none; color: limegreen;" id="waitCalFour"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                <div id="resultFour"></div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Job and Qualification Information Records</h4>
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
                                                                        <a target="_blank" href="{{asset($jobQualificationInformationItem->getDocumentPath())}}"><i class="fa fa-file" style="color: red;"></i></a>
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
                                                                    <a target="_blank" href="{{asset($jobQualificationInformationItem->getProfessionalDocumentPath())}}"><i class="fa fa-file" style="color: red;"></i></a>
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
                                                            <label class="form-label">Grade <span style="color:red;">*</span></label>
                                                            <select class="form-control form-select" name="current_grade" id="current_grade" >
    
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
                                                            <label class="form-label">Salary Level <span style="color:red;">*</span></label>
                                                            <input type="number" class="form-control" id="salary_level" name="salary_level" value="@if (count($userData->getEmployeeCompensation()) > 0){{$userData->getEmployeeCompensation()[0]->salary_level}}@endif">
                                                            <small><b id="salary_levelerror"></b></small>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Salary Point <span style="color:red;">*</span></label>
                                                            <input type="number" name="salary_point" id="salary_point" class="form-control" value="@if (count($userData->getEmployeeCompensation()) > 0){{$userData->getEmployeeCompensation()[0]->salary_point}}@endif">
                                                            <small><b id="salary_pointerror"></b></small>
                                                        </div>
                                                         
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Management Unit</label>
                                                            <select class="form-control form-select" name="management_unit" id="management_unit" >
    
                                                                

                                                                @foreach ($managementUnitLIst as $managementUnitLIstItem)
                                                                <option value="{{$managementUnitLIstItem->id}}" @if (count($userData->getEmployeeCompensation()) > 0) @if ($managementUnitLIstItem->id == $userData->getEmployeeCompensation()[0]->management_unit) selected @endif @endif>{{$managementUnitLIstItem->management_unit}}</option>
                                                                @endforeach
                                                               
                                                              
                                                            </select>
                                                            <small><b id="management_uniterror"></b></small>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <a id="addCompensation" class="btn btn-primary float-end ">Add</a>
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
        </div>
    </div>
</div>


<div class="modal fade selectRefresh" id="addDrugs" tabindex="-1" role="dialog"
            aria-labelledby="modal-title-addDrug-modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-addDrug-modal"> Update Records </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p align="center" style="display: none; color: limegreen;" id="waitCalTwoModal"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                <div id="resultsModal"></div>
                <form id="postingFormsModal" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="form-label">Promotion Type</label>
                                <select class="form-control form-select" name="modal_position_promotion" id="modal_position_promotion" >

                                    <option value="">Promotion Type</option>
                                    @foreach ($positionAndPromotionTypes as $positionAndPromotionTypesItem)
                                        <option value="{{$positionAndPromotionTypesItem->id}}">{{$positionAndPromotionTypesItem->name}}</option>
                                    @endforeach
                                    
                                </select>
                                <small><b id="modal_position_promotionerror"></b></small>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="form-label">Grade</label>
                                <select class="form-control form-select" name="modal_grade" id="modal_grade" >

                                    <option value="">Grade</option>

                                    @foreach ($gradeList as $gradeItem)
                                    <option value="{{$gradeItem->id}}">{{$gradeItem->name}}</option>
                                    @endforeach
                                    
                                    
                                </select>
                                <small><b id="modal_gradeerror"></b></small>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <input type="date" name="modal_reference_date" id="modal_reference_date" class="form-control">
                                <small><b id="modal_reference_dateerror"></b></small>
                            </div>
                                
                        </div>
                    </div>
                    <input type="hidden" id="postingUpdateID" name="postingUpdateID">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <a id="updatePosting" class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('java_script')
<script>
        $(document).on("change","#position_promotionxxx",function(e){
            e.preventDefault();


        let position_promotion = $.trim($('#position_promotion').val());


    

    if(position_promotion.length != 0){

            $("#waitCalTwo").css("display","block");


            $.ajax({
                url:'{{route('get-position-and-promotion-forms')}}',
                type:'POST',
                data:{
                    "_token":"{{ csrf_token() }}",
                    position_promotion:position_promotion
                },
                success:function(data){

                    $("#waitCalTwo").css("display","none");

                    $('#promotionDiv').html(data);

                    
                    
                }
            });


            }

            
        });
    </script>


<script>
    $(document).on('click','#submit',function(e){
        e.preventDefault();

        $('#position_promotionerror').empty();
        $('#gradeerror').empty();
        $('#reference_dateerror').empty();

        let position_promotion = $.trim($('#position_promotion').val());
        let grade = $.trim($('#grade').val());
        let date = $.trim($('#reference_date').val());

        if(position_promotion.length == 0){

        $('#position_promotionerror').html('<p><small style="color:red;">field required.</small></p>');
     
        }

        if(grade.length == 0){

        $('#gradeerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(date.length == 0){

            $('#reference_dateerror').html('<p><small style="color:red;">field required.</small></p>');

         }

         if(date.length != 0 && position_promotion.length != 0 && grade.length != 0){

            $("#waitCalTwo").css("display","block");
            document.getElementById("submit").disabled = true;

            $.ajax({
                type: "POST",
                url: "{{ route('position-and-promotion-process',Crypt::encrypt($userData->id)) }}",
                data: $('#postingForms').serialize(),
                success:function(data){

                    $("#waitCalTwo").css("display","none");
                    document.getElementById("submit").disabled = false;

                    if(data == "error"){

                        $('#results').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#results").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");
                        $("#results").hide().fadeIn(2000);

                    }else{

                        $('#results').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                        $("#results").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");

                        $('#postingForms')[0].reset();

                        $('#recordList').html(data);
                        

                    }

                }
            });

            

        }

        
    });
</script>

<script>
    $(document).on('click','#deletePromotionBtn',function(e){
        e.preventDefault();

        let deleteID = $(this).data('id');

       $.ajax({
        type: "POST",
                url: "{{ route('delete-position-and-promotion-process') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    deleteID:deleteID
                },
                success:function(data){

                    if(data == "error"){

                        $('#results').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#results").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");
                        $("#results").hide().fadeIn(2000);

                        }else{

                        $('#results').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Record deleted successfully.</small></p>');
                        $("#results").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");

                        $('#recordList').html(data);


                    }

                }
       });
    });
</script>

<script>
    $(document).on('click','#addSuper',function(e){
        e.preventDefault();

        $('#supervisors_nameerror').empty();
        $('#supervisors_gradeerror').empty();
        $('#staff_iderror').empty();

        let supervisors_name = $.trim($('#supervisors_name').val());
        let supervisors_grade = $.trim($('#supervisors_grade').val());
        let staff_id = $.trim($('#supervisors_staff_id').val());

        if(supervisors_name.length == 0){

            $('#supervisors_nameerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(supervisors_grade.length == 0){

            $('#supervisors_gradeerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(staff_id.length == 0){

        $('#supervisors_staff_iderror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(supervisors_name.length != 0 && supervisors_grade.length != 0 && staff_id.length != 0 ){

            $("#waitCalThree").css("display","block");
            document.getElementById("addSuper").disabled = true;


            $.ajax({
                type: "POST",
                url: "{{ route('supervisor-information-process',Crypt::encrypt($userData->id)) }}",
                data: $('#supervisorForms').serialize(),
                success:function(data){

                    $("#waitCalThree").css("display","none");
                    document.getElementById("addSuper").disabled = false;

                    if(data == "error"){

                        $('#resultsThree').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#resultsThree").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");
                        $("#resultsThree").hide().fadeIn(2000);

                    }else{

                        $('#resultsThree').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                        $("#resultsThree").hide().fadeIn(2000);
                        $('html, body').animate({scrollTop:0},"slow");

                        $('#supervisorForms')[0].reset();

                        $('#recordListThree').html(data);
                        

                    }

                }
            });

        

        }


    });
</script>

<script>
    $(document).on('click','#submitDocs',function(e){
        e.preventDefault();

        $('#highest_academic_qualificationerror').empty();
        $('#document_typeerror').empty();
        $('#professional_qualificationerror').empty();
        $('#document_type_professionalerror').empty();

        $('#job_cadreerror').empty();
        $('#job_categoryerror').empty();
        $('#number_of_yearserror').empty();

        $('#academic_documenterror').empty();
        $('#professional_documenterror').empty();
        


        let highest_academic_qualification = $.trim($('#highest_academic_qualification').val());
        let document_type = $.trim($('#document_type').val());
        // let professional_qualification = $.trim($('#professional_qualification').val());
        // let document_type_professional = $.trim($('#document_type_professional').val());

        let job_cadre = $.trim($('#job_cadre').val());
        let job_category = $.trim($('#job_category').val());
        let number_of_years = $.trim($('#number_of_years').val());

        let academic_document = $('#academic_document').val();
       // let professional_document = $('#professional_document').val();

        if(highest_academic_qualification.length == 0){

        $('#highest_academic_qualificationerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(document_type.length == 0){

        $('#document_typeerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        // if(professional_qualification.length == 0){

        // $('#professional_qualificationerror').html('<p><small style="color:red;">field required.</small></p>');

        
        // }

        // if(document_type_professional.length == 0){

        // $('#document_type_professionalerror').html('<p><small style="color:red;">field required.</small></p>');

        // }

        if(job_cadre.length == 0){

        $('#job_cadreerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(job_category.length == 0){

        $('#job_categoryerror').html('<p><small style="color:red;">field required.</small></p>');


        }

        if(number_of_years.length == 0){

        $('#number_of_yearserror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(academic_document.length == ''){

        $('#academic_documenterror').html('<p><small style="color:red;">field required.</small></p>');

        }

        // if(professional_document.length == ''){

        // $('#professional_documenterror').html('<p><small style="color:red;">field required.</small></p>');

        // }

        if(highest_academic_qualification.length != 0 && document_type.length != 0 
        && professional_qualification.length != 0 && document_type_professional.length != 0 
        && job_cadre.length != 0 && job_category.length != 0 && number_of_years.length != 0  ){

            $("#waitCalFour").css("display","block");

            document.getElementById("submitDocs").disabled = true;

            var form = $('#acadeForms')[0];
            var data = new FormData(form);

             $.ajax({
                url: "{{ route('update-job-and-qualification-info',Crypt::encrypt($userData->id)) }}",
                 type: 'POST',              
                    data: data,
                    enctype:'multipart/form-data',
                    processData:false,
                    contentType:false,
                success:function(data){

                    console.log(data);

                    $("#waitCalFour").css("display","none");

                    document.getElementById("submitDocs").disabled = false;

                    if(data == "error"){

                    $('#resultFour').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                    // $("#resultsFour").hide().fadeIn(2000);
                    // $('html, body').animate({scrollTop:0},"slow");
                    // $("#resultsFour").hide().fadeIn(2000);

                    }else{

                    $('#resultFour').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                    // $("#resultsFour").hide().fadeIn(2000);
                    // $('html, body').animate({scrollTop:0},"slow");

                    $('#acadeForms')[0].reset();

                    $('#jobQualificationList').html(data);


                    }

                    
                    
                }
            });

        

        }

       


    });
</script>


<script>
    $(document).on('click','#addCompensation',function(e){
        e.preventDefault();

        $('#current_gradeerror').empty();
        $('#salary_levelerror').empty();
        $('#salary_pointerror').empty();

        let current_grade = $.trim($('#current_grade').val());
        let salary_level = $.trim($('#salary_level').val());
        let salary_point = $.trim($('#salary_point').val());

        if(current_grade.length == 0){

            $('#current_gradeerror').html('<p><small style="color:red;">field required.</small></p>');

            }

            if(salary_level.length == 0){

            $('#salary_levelerror').html('<p><small style="color:red;">field required.</small></p>');

            }

            if(salary_point.length == 0){

            $('#salary_pointerror').html('<p><small style="color:red;">field required.</small></p>');

            }

            if(current_grade.length != 0 && salary_level.length != 0 && salary_point.length != 0){

                $("#waitCalFive").css("display","block");
                document.getElementById("addCompensation").disabled = true;


                $.ajax({
                type: "POST",
                url: "{{ route('update-employee-compensation-info',Crypt::encrypt($userData->id)) }}",
                data: $('#compensationForm').serialize(),
                success:function(data){

                    $("#waitCalFive").css("display","none");
                    document.getElementById("addCompensation").disabled = false;

                    if(data == "error"){

                        $('#resultFive').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#resultFive").hide().fadeIn(2000);
                        // $('html, body').animate({scrollTop:0},"slow");
                        // $("#resultFive").hide().fadeIn(2000);

                    }else{

                        $('#resultFive').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                        $("#resultFive").hide().fadeIn(2000);
                        // $('html, body').animate({scrollTop:0},"slow");                        
                        

                    }

                }
            });



            }


    });
</script>

<script>
    $(document).on('click','#updatePosting',function(e){
        e.preventDefault();

        $('#modal_position_promotionerror').empty();
        $('#modal_gradeerror').empty();
        $('#modal_reference_dateerror').empty();

        let position_promotion = $.trim($('#modal_position_promotion').val());
        let grade = $.trim($('#modal_grade').val());
        let date = $.trim($('#modal_reference_date').val());

        if(position_promotion.length == 0){

        $('#modal_position_promotionerror').html('<p><small style="color:red;">field required.</small></p>');
     
        }

        if(grade.length == 0){

        $('#modal_gradeerror').html('<p><small style="color:red;">field required.</small></p>');

        }

        if(date.length == 0){

        $('#modal_reference_dateerror').html('<p><small style="color:red;">field required.</small></p>');

         }

         if(date.length != 0 && position_promotion.length != 0 && grade.length != 0){

            $("#waitCalTwoModal").css("display","block");
            document.getElementById("updatePosting").disabled = true; 

            $.ajax({
                type: "POST",
                url: "{{ route('position-and-promotion-process-update',Crypt::encrypt($userData->id)) }}",
                data: $('#postingFormsModal').serialize(),
                success:function(data){

                    $("#waitCalTwoModal").css("display","none");
                    document.getElementById("updatePosting").disabled = false;

                    if(data == "error"){

                        $('#resultsModal').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#resultsModal").hide().fadeIn(2000);
                        
                        $("#resultsModal").hide().fadeIn(2000);

                    }else{

                        $('#resultsModal').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i> Records saved successfully</small></p>');
                        $("#resultsModal").hide().fadeIn(2000);
        

                        $('#recordList').html(data);
                        

                    }

                }
            });

            

        }


     
    });
</script>

<script>
    $(document).on('click','#postingModalUpdate',function(e){
        e.preventDefault();

        $("#waitCalTwoModal").css("display","block");

        let postingUpdateID = $(this).data('id');

        $('#postingUpdateID').val(postingUpdateID);


        $.ajax({
        type: "POST",
                url: "{{ route('get-postion-position-data') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    postingUpdateID:postingUpdateID
                },
                dataType:'JSON',
                success:function(data){

                    $("#waitCalTwoModal").css("display","none");

                    let jsonObject = data;

                    console.log(jsonObject['data']['date']);

                    

                    $('#modal_reference_date').val('');
                    $('#modal_position_promotion').val('');
                    $('#modal_grade').val('');


                    $('#modal_reference_date').val(jsonObject['data']['date']);
                    $('#modal_position_promotion').val(jsonObject['data']['type_id']);
                    $('#modal_grade').val(jsonObject['data']['grade_id']);

                    

                }
       });

    });
</script>


<script>
    $(document).on('click','#findSupervisorBtn',function(e){
        e.preventDefault();

        alert("dsds");
    });
</script>

   
@endsection