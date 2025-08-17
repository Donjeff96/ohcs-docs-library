@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Update Information</h4>
                        
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Update Profile Details</a></li>
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
                           <br><br>
                            <div class="basic-form">
                                <form action="{{route('update-user-information-process')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">User Name
                                                   
                                                </label>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" class="form-control"
                                                        placeholder="{{auth()->user()->name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Grade </label>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" class="form-control"
                                                        placeholder="{{auth()->user()->title}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Email </label>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" class="form-control" placeholder="{{auth()->user()->email}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Username</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" class="form-control"
                                                        placeholder="{{auth()->user()->username}}">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Salary Level<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" placeholder="{{auth()->user()->gradeLevel}}" name="grade_level" value="{{auth()->user()->gradeLevel}}">
                                                    @error('grade_level')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                                </div>

                                            </div>
                                        </div> --}}
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Gender <span
                                                    class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control form-select" name="gender">
                                                        <option value="">-- SELECT GENDER --</option>
                                                        <option value="Male" @if (auth()->user()->gender == "Male")
                                                            selected
                                                        @endif>Male</option>
                                                        <option value="Female" @if (auth()->user()->gender == "Female")
                                                            selected
                                                        @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Division <span
                                                    class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control form-select" name="division">
                                                        <option value="">-- SELECT DIVISION --</option>
                                                        @foreach ($divisionalList as $item)
                                                            <option value="{{$item->id}}" @if (auth()->user()->division_id == $item->id )
                                                                selected
                                                            @endif>{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('division')
                                                    <small style="color: red">{{$message}}</small>
                                                @enderror
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="form-group"><button type="submit"
                                                    class="btn btn-primary float-end">Update</button></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                                
                                                placeholder=""  name="phone_number" id="phone_number" required value="@if(count($userData->getContactInformation())){{$userData->getContactInformation()[0]->phone_number}}@else{{old('phone_number')}}@endif">
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
                                                placeholder=""  name="email" id="email" value="@if(count($userData->getContactInformation())){{$userData->getContactInformation()[0]->emal}}@else{{old('email')}}@endif" required>
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
                                            <input type="text" class="form-control" id="digital_address" name="digital_address" value="@if(count($userData->getContactInformation())){{$userData->getContactInformation()[0]->digital_address}}@else{{old('digital_address')}}@endif">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label class="form-label">Postal Address</label>
                                            <input type="text" class="form-control" id="postal_address" name="postal_address" value="@if(count($userData->getContactInformation())){{$userData->getContactInformation()[0]->postal_address}}@else{{old('postal_address')}}@endif">
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
    </div>
</div>
@endsection


@section('java_script')
    
@endsection