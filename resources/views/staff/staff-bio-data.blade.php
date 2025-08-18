@extends('layout.app')


@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Documentation</h4>
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
                                            Upload Relevant Documents
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
                                                        <h4 class="card-title">Upload Documents</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="basic-form">
                                                            <div class="card-body">
                                    
                                        @if (session('success'))
                                        <div class="alert alert-success text-center"><span> <i class="fa fa-check"></i> {{session('success')}}</span></div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger text-center"><span> <i class="fa fa-times"></i> {{session('error')}}</span></div>
                                        @endif
                                        <form method="POST" action="{{route('upload-staff-documents-process',Crypt::encrypt($userData->id))}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Document Type</label>
                                                        <select class="form-control form-select" id="document_type" name="document_type">
                                                            <option value="">Select Type</option>
                                                            @foreach ($documentType as $documentTypeItem)
                                                                <option value="{{$documentTypeItem->id}}" @if ($documentTypeItem->id == old('document_type')) selected @endif>{{$documentTypeItem->description}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                        @error('document_type')
                                                            <small style="color: red">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Document Classification</label>
                                                        <select class="form-control form-select" id="document_classification" name="document_classification">
                                                            <option value="">Select Classification</option>
                                                        </select>
                                                        @error('document_classification')
                                                            <small style="color: red">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="documnet_description" id="documnet_description" cols="50" rows="15">{{old('documnet_description')}}</textarea>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Document</label><br>
                                                        <input type="file"  id="files[]" name="files[]" multiple accept=".pdf">
                                                        
                                                    </div>
                                                    @error('files')
                                                        <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="form-group text-right">
                                                <button type="submit" class="btn btn-primary float-end ">Upload</button>
                                            </div>
                                            
                                                </form>
                                            </div>
                                            
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                    
                                
                                </div>


                                <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    <h4 class="card-title">Documents List </h4>
                                </div>
                                <div class="card-body table-responsive">
                                    <table id="example1" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th>Document</th>
                                                <th></th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documentList as $documentitem)
                                                <tr>
                                                    <td><b>{{$documentitem->getDocumentClassification()->name}}</b></td>
                                                    <td><a  id="pdfViewerBtn" data-id="{{asset($documentitem->document_path)}}"><i class="fa fa-file-pdf"> View</i></a> </td>
                                                    <td>
                                                        @if ($documentitem->status == "Pending")
                                                            <p style="color: red;"> {{$documentitem->status}}</p>
                                                        @else
                                                        <p style="color: green;"> {{$documentitem->status}}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card shadow mb-4" style="height:600px;">
                                <p align="center" style="display: none; color: limegreen;" id="waitCal"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                                <br>
                                <div class="card-body " >
                                    
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




@endsection

@section('java_script')
<script>
    $(document).on('change','#document_type',function(e){
        e.preventDefault();

        let docuumentat_type = $(this).val();

        
      

        $.ajax({
            type:'POST',
            url:'{{route('get-document-classification-drop-down')}}',
            data:{
                "_token": "{{ csrf_token() }}",
                'document_type_id': docuumentat_type
            },
            success:function(data){

                $('#document_classification').html(data);

            }
        });

        
    });
</script>


<script>
    $(document).on('click','#pdfViewerBtn',function(e){
        e.preventDefault();


        let paths = $(this).data('id');

        var objectTag = document.getElementById('viewerPDF');

        

        objectTag.data =paths;

        console.log(paths);



        
    });

    function chnageObjectData (newData){

        var objectTag = document.getElementById('viewerPDF');

        objectTag.data = newData;


    }
</script>

   
@endsection