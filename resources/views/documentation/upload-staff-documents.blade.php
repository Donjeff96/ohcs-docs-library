@extends('layout.app')


@section('content')

<div class="content-body">
    <div class="warper container-fluid">
        <div class="main_container">


            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Document Management</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Staff Profile</a>
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
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-upload"></i> Upload Documents </h4>
                        </div>
                        <div class="card-body">
                            <br>
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
                                            <textarea class="form-control" name="documnet_description" id="documnet_description" cols="30" rows="10">{{old('documnet_description')}}</textarea>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Document Classification</label><br>
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