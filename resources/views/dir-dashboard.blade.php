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
                        <div class="widget card card-primary bg-card1">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Your {{Str::plural('Document',$documentCount)}}</span>
                                        <h3 class="mb-0 text-white"><a target="_blank" style="color: white;'" href="#">{{$documentCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="card shadow widget-2">
                        <div class="card-header">
                            <h4 class="card-title">Recent Uploads</h4>
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
                                        <a id="pdfViewerBtn" data-bs-toggle='modal' data-bs-target='#addDrugs' data-id='{{asset($iuploadItem->document_path)}}#toolbar=0' type="button" class="ms-btn-icon btn-success" name="button">
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                    
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow widget1">
                        <div class="card-header">
                            <h4 class="card-title">Officers</h4>
                            <h4 class="card-title"><a href="{{route('my-divisional-staff')}}">View All</a></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="widget-media list-doctors best-doctor">
                                        <div class="timeline row">
                                            @for ($i = 1; $i <= 6; $i++)
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="timeline-panel card p-4 mb-4">
                                                    <div class="media">
                                                        @if (key_exists('thumbnailphoto',$data[$i-1]))
                                                        <img alt="image" src="data:image/jpeg;base64,{{base64_encode($data[$i-1]['thumbnailphoto'][0])}}">
                                                        @else
                                                        <img alt="image" src="assets/images/profile_avater.png">
                                                        @endif
                                                    </div>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            <h4 class="mb-2">{{$data[$i-1]['displayname'][0]}}</h4>
                                                        </a>
                                                        @if (key_exists('title',$data[$i-1]))
                                                           <p class="mb-2">{{ $data[$i-1]['title'][0]}}</p>
                                                        @else
                                                            <p class="mb-2"><b>Not Available</b></p>
                                                        @endif
                                                    </div>
                                                    <div class="btn-group-style-1">
                                                        <div class="btn-content">
                                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <div class="form-content">
                                                                    <a href="{{route('staff-bio-information',Crypt::encrypt($data[$i-1]['userprincipalname'][0]))}}">
                                                                        <span class="ml-2">Profile</span>
                                                                    </a>
                                                                    <a href="#">
                                                                        <span class="ml-2">Documents</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card shadow widget1">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body">
                            <canvas id="chart2" width="100%" height="299"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade selectRefresh" id="addDrugs" tabindex="-1" role="dialog"
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
                {{-- <object id="viewerPDF"  type="application/pdf" style="height:100%;width:100%"></object>  --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

        $('#object').html('<object id="viewerPDF" data="'+paths+'"  type="application/pdf" style="height:100%;width:100%"></object>');

                
    });
</script>
@endsection