@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Divisional Management</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Divisional Management</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4 class="card-title">List of Staff</h4>
                        </div>
                        <div class="card-body">
                            
                        
                            <div class="basic-form">
                                <form action="{{route('list-divisional-staffs-process')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4"></div>
                                        <div class="col-xl-4">
                                            <div class="form-group">
                                              
                                               <select name="division" id="division" class="form-control form-select">
                                                <option value="">-- SELECT DIVISION --</option>
                                                @foreach($getUnits as $unit)
                                                <option value="{{$unit->initials}}"

                                                    @if (session('division'))
                                                        @if (session('division') == $unit->initials)
                                                          selected  
                                                        @endif
                                                    @endif
                                                    
                                                    >{{$unit->name}}</option>
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
                                                    class="btn btn-primary" style="margin-top: 10px;"><i class="fa fa-list"></i> List</button>
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

        @session('data')
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example1" class="display nowrap">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Username</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
        
                                            @for ($i = 1; $i <= (int)session('count'); $i++)
                                            <tr>
                                                
                                                <td align="center">
                                                    @if (key_exists('thumbnailphoto',session('data')[$i-1]))
                                                    <img src="data:image/jpeg;base64,{{base64_encode(session('data')[$i-1]['thumbnailphoto'][0])}}" alt="people" height="55" width="55">
                                                    
                                                    @else
                                                    <img src="{{asset('avater.png')}}" alt="people" height="55" width="55">
                                                    @endif
                                                </td>
                                                <td><b>{{ session('data')[$i-1]['displayname'][0]}}</b></td>
                                                <td>
                                                    @if (key_exists('title',session('data')[$i-1]))
                                                    {{ session('data')[$i-1]['title'][0]}}
                                                    @else
                                                    <b >Not available</b>
                                                    @endif
                                                </td>
                                                <td>{{ session('data')[$i-1]['samaccountname'][0]}}</td> 
                                                <td>
                                                    <a target="_blank" href="{{route('staff-bio-information',Crypt::encrypt(session('data')[$i-1]['userprincipalname'][0]))}}"> <span class='fas fa-eye' style="color:green;"> View</span> </a>
                                                </td>
                                            </tr>
                                            @endfor
                                        </tbody>
                                    </table> 
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsession
    </div>
</div>
  
@endsection

@section('java_script')
    {{-- <script>
        $(document).on('click','#loadingBtn',function(e){
            e.preventDefault();
            alert("sds")
        });
    </script> --}}
@endsection



