@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Staff Album</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Staff Album</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">Search</h4>
                        </div>
                        <div class="card-body">
                            
                        
                            <div class="basic-form">
                                <form action="{{route('staff-list-search-process')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                              
                                               <select name="division" id="division" class="form-control form-select">
                                                <option value="">-- SELECT DIVISION --</option>
                                                @foreach($getDivision as $divisionItem)
                                                <option value="{{$divisionItem->id}}"

                                                    @if (session('division'))
                                                        @if (session('division') == $divisionItem->id)
                                                          selected  
                                                        @endif
                                                    @endif
                                                    
                                                    >{{$divisionItem->name}}</option>
                                                @endforeach
                                               </select>
                                               @error('division')
                                                <p class="text-danger">{{$message}}</p>
                                               @enderror
                                                   
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary" style="margin-top: 10px;"><i class="fa fa-list"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('userList'))

        @if (session('userList') == "empty")
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="text-center">
                    <div class="alert alert-danger"><h2>No Records Found</h2></div>
                </div>
            </div>

        </div>  
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="widget-media list-doctors best-doctor">
                    <div class="timeline row">
                        @foreach (session('userList') as $item)
                        <div class="col-sm-6 col-lg-4">
                            <div class="timeline-panel card p-4 mb-4">
                                <div class="media">
                                    
                                    @if (!empty($item->photoUrl))
                                    <img alt="image" src="data:image/jpeg;base64,{{$item->photoUrl}}">
                                    @else
                                    <img src="{{asset('avater.png')}}" alt="image">
                                    @endif
                                </div>
                                <div class="media-body">
                                    <a href="#">
                                        <h4 class="mb-2"><i class="fa fa-user"></i> {{$item->name}}</h4>
                                    </a>
                                    <small><i class="fa fa-envelope"></i> {{$item->email}}</small>
                                    <p class="mb-2"><i class="fa fa-id-card"></i>  {{$item->title}}</p>
                                    @if (count($item->getContactInformation()) > 0 )
                                    <hr>
                                      <p class="mb-2"><i class="fa fa-phone"></i> {{$item->getContactInformation()[0]->phone_number}}</p>
                                    @endif
                                    
                                </div>
                                <div class="btn-group-style-1">
                                    <div class="btn-content">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        {{-- <div class="dropdown-menu">
                                            <div class="form-content">
                                                <a href="#">
                                                    <span class="ml-2"><a data-bs-toggle="modal" id="modalBtn" data-id="{{$item->id}}" data-bs-target="#addDrugs">Assign Role</a> </span>
                                                </a>
                                                <a href="#">
                                                    <span class="ml-2">Leave</span>
                                                </a>
                                                
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>    
        @endif
          
        @endif

        
        
    </div>
</div>


<div class="modal fade selectRefresh" id="addDrugs" tabindex="-1" role="dialog"
aria-labelledby="modal-title-addDrug-modal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-title-addDrug-modal"> Assign Role </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div>
                <p id="confirmation" style="text-align:center"></p>
                <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > Saving Information, please wait..</p>

            </div>
            <br><br>
            <form class="row align-items-start" id="form">
                <input type="hidden"  name="userID" id="userID">
                @csrf
                <div class="col">
                    <div class="form-group">
                        <select id="levels" name="levels" class="form-control form-select">
                            <option  value="">-- SELECT TEIR --</option>
                            <option value="TEIR_ONE">TEIR ONE</option>
                            <option value="TEIR_TWO">TEIR TWO</option>
                        </select>
                        <span id="levelserror"></span>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <select name="status" id="status" class="form-control form-select">
                            <option value="">-- SELECT STATUS --</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <span id="statuserror"></span>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Note</label>
                        <textarea id="note" name="note" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </form><br><br>
            <div id="tableList"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="button" id="saveBTn" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
</div>   
@endsection



