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
                        <li class="breadcrumb-item active"><a href="#">Document Managemet</a>
                        </li>
                    </ol>
                </div>
            </div>


            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between doctor-info-details">
                                <div class="d-flex left-content">
                                    <div class="media align-self-start">
                                        

                                            @if (!empty($userData->photoUrl))

                                            <img src="data:image/jpeg;base64,{{$userData->photoUrl}}" alt="image" class="rounded-circle shadow" width="90">
                                            
                                            @else

                                            <img alt="image" class="rounded-circle shadow" width="90"
                                            src="{{asset('assets/images/client.jpg')}}">

                                            @endif
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="mb-2">{{$userData->name}}</h2>
                                        <p class="mb-md-2 mb-sm-4 mb-2">{{$userData->email}}</p>
                                            <p class="mb-md-2 mb-sm-4 mb-2">@if (!empty($userData->title))
                                                {{$userData->title}}
                                                @else
                                                <b style="color: red;">Not available</b>
                                                @endif</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> --}}

            



            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-list"></i> List Documents </h4>
                        </div>
                        <div class="card-body">
                            <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                            <div id="results"></div>
                            <br>
                            <table class="table table-striped table-bordered" style="width:800px" align="center">
                                       
                                <tr>
                                    <td align="right"><label style="padding-top:20px;">Document Type:</label></td>
                                    <td><select class="form-control form-select" id="document_type" name="document_type">
                                        <option value="">-- SELECT DOCUMENT TYPE --</option>
                                        @foreach ($documentType as $documentTypeItem)
                                            <option value="{{$documentTypeItem->id}}" @if ($documentTypeItem->id == old('document_type')) selected @endif>{{$documentTypeItem->description}}</option>
                                        @endforeach
                                        
                                    </select>
                                    <span id="document_typeerror"></span>
                                    </td>
                                    <td><div style="padding-top:10px;"><a  id="listDocuments" class="btn btn-primary btn-sm" ><i class="fa fa-list"></i> Filter</a></div></td>
                                </tr>
                            </table>
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
                            <div id="tableList">
                                <table id="example1" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documentList as $documentitem)
                                            <tr>
                                                <td>{{$documentitem->getDocumentClassification()->name}}</td>
                                                <td align="center"><a  id="pdfViewerBtn" data-id="{{asset($documentitem->document_path)}}#toolbar=0"><i class="fa fa-file-pdf"></i> View</a> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" style="height:700px;">
                    <div class="card shadow mb-4">
                        <p align="center" style="display: none; color: limegreen;" id="waitCal"><img src="{{ asset('images/spinner-grey.gif')}}" > Loading, please wait ...</p>
                        <br>
                        <div class="card-body ">
                            
                           <div id="pdfViewer" style="height:550px;">
                            @if (count($documentList) > 0)
                                
                            
                            <object id="viewerPDF"  data="{{asset($documentList[0]->document_path)}}#toolbar=0" type="application/pdf" style="height:100%;width:100%"></object> 
                    

                            @endif
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

        // var objectTag = document.getElementById('viewerPDF');

        // objectTag.data =paths;

        $('#pdfViewer').html('<object id="viewerPDF" data="'+paths+'"  type="application/pdf" style="height:100%;width:100%"></object>');

  
    });

   
</script>


<script>
    $(document).on('click','#listDocuments',function(e){
        e.preventDefault();

        $('#document_typeerror').empty();

        let documentTypeID = $("#document_type").val();


        if(documentTypeID.length == 0){

        $('#document_typeerror').html('<p><small style="color:red;">field required.</small></p>');

        }else{

            $("#wait").css("display","block");
            document.getElementById("listDocuments").disabled = true;

            $.ajax({
            type:'POST',
            url:'{{route('list-document-with-type')}}',
            data:{
                "_token": "{{ csrf_token() }}",
                'document_type_id': documentTypeID
            },
            success:function(data){

                $("#wait").css("display","none");
                document.getElementById("listDocuments").disabled = false;

                if(data == "empty"){

                    $('#results').html('<p class="alert alert-danger" align="center"><small><i class="fa fa-times"></i> No Records Found</small></p>');
                    $("#results").hide().fadeIn(2000);


                }else{

                    $('#tableList').html(data);

                }

                

            }
        });



        }


    });
</script>

   
@endsection