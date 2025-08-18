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
                                        

                                            <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{asset('images/file_image.png')}}">
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2">{{ $userData->name }}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">SN: {{ $userData->file_number }}</p>
                                            <p class="mb-md-2 mb-sm-4 mb-2"><i class="fa fa-building"></i> {{ $userData->getInstitution()->name }}</p>
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

                                                <div class="col-xl-4">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Rank  
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            {{ $userData->getRank()->name }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Institution
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <b>{{ $userData->getInstitution()->name }}</b>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label">Gender
                                                            <span class="text-info">:</span>
                                                        </label>
                                                        <div class="col-lg-6">
                                                            <b>{{ $userData->grader }}</b>
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
                                 

                                                             <div class="preview">
                                                                <img src="{{asset('assets/images/client.jpg')}}" src="#" alt="img" height="200" width="200">
                                                            </div>
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
                                                                    
                                                                    placeholder=""  name="phone_number" id="phone_number" required value="">
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
                                                                    placeholder=""  name="email" id="email" value="" required>
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
                                                                <input type="text" class="form-control" id="digital_address" name="digital_address" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Postal Address</label>
                                                                <input type="text" class="form-control" id="postal_address" name="postal_address" value="">
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
                                                            <input type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="">
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
                                                                   <option value="{{$relationshipItem->id}}" >{{$relationshipItem->name}}</option>
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
                                                            <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label"> Digital Address
                                                            </label>
                                                            <input type="text" class="form-control" id="digital_address" name="digital_address" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Postal Address</label>
                                                            <input type="text" class="form-control" id="postal_address" name="postal_address" value="">
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
                                                            <input type="text" class="form-control" placeholder="Name" name="person_name" id="person_name" value="">
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
                                                                   <option value="{{$relationshipItem->id}}">{{$relationshipItem->name}}</option>
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
                                                            <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Email</label>
                                                            <input type="text" class="form-control" id="email" placeholder="" name="email" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label"> Digital Address
                                                            </label>
                                                            <input type="text" class="form-control" id="digital_address" name="digital_address" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Postal Address</label>
                                                            <input type="text" class="form-control" id="postal_address" name="postal_address" value="">
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
                </div>
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