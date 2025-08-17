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
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-primary bg-card3">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-book fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Total Documentation</span>
                                        <h3 class="mb-0 text-white"><a href="{{route('my-documentation')}}" style="color: white">{{$documentCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-warning bg-card1">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">Entry Documentation</span>
                                        <h3 class="mb-0 text-white"><a href="{{route('my-documentation')}}" style="color: white">{{$entryDocsCount}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4 col-lg-6">
                        <div class="widget card card-danger bg-card2">
                            <div class="card-body">
                                <div class="media text-center">
                                    <span>
                                        <i class="fas fa-file-pdf  fa-2x"></i>
                                    </span>
                                    <div class="media-body">
                                        <span class="text-white">In-service Documentation</span>
                                        <h3 class="mb-0 text-white"><a href="{{route('my-documentation')}}" style="color: white">{{$inServiceDocsCount}}</a></h3>
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
                            <h4 class="card-title">Statistics</h4>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <canvas id="chart3" width="100%" height="220"></canvas>
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
        maintainAspectRatio: false,
        title: {
            display: false,
            text: 'Documentation'
        }
    }
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