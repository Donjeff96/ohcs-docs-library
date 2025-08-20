@extends('layout.app')

@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary"></b></h4>
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
                                    Pending Documentation
                                </button>
                            </li>
                            
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card m-t-30">
                                    <div class="card-body">
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Pending Approvals</h4>
                                        </div>
                                        <div class="card-body">
                                            
                                              
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="card shadow mb-4">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Documents List </h4>
                                                        </div>
                                                        <div class="card-body table-responsive">
                                                            @if (count($documentList)>0)
                                                            <div id="tableList">
                                                                <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                                                <div id="result"></div>
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="center"><b>Document</b></td>
                                                                            <td></td>
                                                                            <td align="center"><b>Action</b></td>
                                                                            
                                                                        </tr>
                                                                        @foreach ($documentList as $documentitem)
                                                                            <tr>
                                                                                <td>{{$documentitem->getDocumentClassification()->name}}</td>
                                                                                <td align="center"><a style="color:blue;"  id="pdfViewerBtn" data-id="{{asset($documentitem->document_path)}}"><i class="fa fa-file-pdf"></i> View</a> </td>
                                                                                <td>
                                                                                    <select name="setStatus" id="setStatus" class="form-control form-select">
                                                                                        <option value="" data-id="{{$documentitem->id}}">choose status</option>
                                                                                        <option value="Approve" data-id="{{$documentitem->id}}">Approve </option>
                                                                                        <option value="Disapprove" data-id="{{$documentitem->id}}">Disapprove</option>
                                                                                    </select>
                                                                                    <span id="{{$documentitem->id}}"></span>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            @else
                                                              <div class="alert alert-warning"><p align="center">No Pending Documentation Found !</p></div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4" style="height:600px;">
                                                    <div class="card shadow mb-4">
                                                        <p align="center" style="display: none; color: limegreen;" id="waitCal"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                                        <br>
                                                        <div class="card-body ">
                                                            
                                                            @if (count($documentList) > 0)
                                                                
                                                            
                                                            <object id="viewerPDF"  data="{{asset($documentList[0]->document_path)}}" type="application/pdf" style="height:100%;width:100%"></object> 
                                                    

                                                            @endif
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
</div>





@endsection

@section('java_script')



<script>
    $(document).on('click','#pdfViewerBtn',function(e){
        e.preventDefault();


        let paths = $(this).data('id');

        var objectTag = document.getElementById('viewerPDF');

        objectTag.data = paths;
  
    });

   
</script>

<script>
    $(document).on('change','#setStatus',function(e){
        e.preventDefault();


        let selected = $(this).find('option:selected');
        let extra = selected.data('id'); 

        let selectedValue =$.trim($(this).val());

        if(selectedValue.length == 0){

        $('#'+extra).html('<p><small style="color:red;">field required.</small></p>');

        }else{

            $("#wait").css("display","block");
            document.getElementById("setStatus").disabled = true;

            $.ajax({
                type: "POST",
                url: "{{ route('approve-users-document-process') }}",
                data:{
                    "_token":"{{ csrf_token() }}",
                    'document_id':extra,
                    'selectedValue':selectedValue
                },
                success:function(data){

                    $("#wait").css("display","none");
                    document.getElementById("setStatus").disabled = false;

                    if(data == "error"){

                        $('#result').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> Something went wrong, please try again</small></p>');
                        $("#result").hide().fadeIn(2000);
                  

                    }else{

                        $('#result').html('<p class="alert alert-success" align="center"><small><i class="fa fa-check"></i>Document approved successfully</small></p>');
                        $("#result").hide().fadeIn(2000);
    
                        

                    }

                
                }
       });


        }
        
    });
</script>

@endsection
