@extends('layout.app')


@section('content')
<div class="content-body">
    <div class="warper container-fluid">
        <div class="add_Test main_container">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4 class="text-primary">Add User Category</h4>
                    
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Add Category</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <h5 class="mb-1">Assign Privilege</h5>
                                <p class="mb-0 font-13 text-secondary"><i class='bx bxs-user'></i> Assign Privilege</p>
                            </div>
                                <form method="POST" action="" id="priviForm">
                                    <br>
                                    @if (session('error_exist'))
                                      <p class="alert alert-danger" align="center">{{session('error_exist')}}</p>
                                    @endif
            
                                    @if (session('success_message'))
                                      <p class="alert alert-success" align="center">{{session('success_message')}}</p>
                                    @endif
                                    
                                    <br>
                                    @csrf
            
                                    <table class="table table-striped table-bordered" style="width:100%">
                                       
                                        <tr>
                                            <td><label>Category:</label></td>
                                            <td><select class="form-select" name="category" id="category">
                                                    <option value="" disabled selected>--SELECT CATEGORY--</option>
                                                    @foreach ($userCatList as $userCatList)
                                                        <option value="{{ $userCatList->id }}" @if (old('cat') == $userCatList->id) selected @endif>{{$userCatList->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span id="caterror"></span>
                                            </td>
                                            <td><div><input type="submit" id="assign" class="btn btn-success btn-sm" value="Assign Privileges"></div></td>
                                        </tr>
                                    </table>
                                    <br>
                                    <div>
                                        <p id="confirmation" style="text-align:center"></p>
                                        <p align="center" style="display: none; color: limegreen;" id="wait"><img src="{{ asset('images/spinner-grey.gif')}}" > saving privileges. Please wait....</p>
                                        <p align="center" style="display: none; color: limegreen;" id="wait_fetch"><img src="{{ asset('images/spinner-grey.gif')}}" > Fetching privileges for selected category. Please wait....</p>
                                    </div> <br><br>           
                                    @if ($parents != null)
                                    <div id="listarea">
                                        <table class="table table-striped table-bordered" style="width:100%">
                                            @foreach ($parents as $mainlink)
                                                <tr>
                                                    <td colspan="2"><h7><strong><?php echo $mainlink->link_name; ?></strong></h7></td>
                                                </tr>
                                                    @foreach ($child as $subs)
                                                        @if ($mainlink->id == $subs->link_parent)
                                                    <tr>
                                                        <td class="text-center" style="width: 60px;"><input type="checkbox" name="priv_check[]" id="priv_check" value="{{$subs->link_id}}"></td>
                                                        <td>{{$subs->link_name}}</td>
                                                    </tr>
                                                        @endif
                                                    @endforeach
                                            @endforeach
                                        </table>
                                    </div>
                                    @endif
                                </form>
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
    $(document).on("change","#category",function(){

    var dropvalue = $("#category").val();

    $("#wait_fetch").css("display", "block");

    $.ajax({
        type: "POST",
        url: "{{ route('privi') }}",
        data: $('#priviForm').serialize(),
        success:function(data) {

            $('#listarea').html(data);
            $("#assign").removeAttr('disabled');
            $("#wait_fetch").css("display","none");


        }

    });
});

$(document).on("click", "#assign", function(e){
        e.preventDefault();

        $("#caterror").empty();
        var user_cat = $.trim($("#category").val());
        if(user_cat.length == 0){
            $("#caterror").html('<p><small style="color:red;">Choose an option</small></p>');
        }
        if(user_cat.length != 0){


        $("#wait").css("display","block");
        $("#assign").attr("disabled", "disabled");

        $.ajax({
            type: "POST",
            url: "{{ route('saveprivi') }}",
            data: $('#priviForm').serialize(),
            success: function(e) {

                console.log(e)

                if(e=="d_fail"){
                    $("#wait").css("display","none");
                    $("#assign").removeAttr('disabled');


                    $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> User privilege assignment failed</span></div>");
                    $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                }else if(e=="ok"){

                    $("#wait").css("display","none");
                    $("#assign").removeAttr('disabled');


                    $('#confirmation').html("<div align='center'><span class='alert alert-success'><i class='icon icon-ok-sign'></i> User privileges were assigned successfully</span></div>");
                    $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                }else if(e=="unchecked"){

                    $("#wait").css("display","none");
                    $("#assign").removeAttr('disabled');


                    $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> Privilege assignment failed. No option was checked before assigning privileges</span></div>");
                    $("#confirmation").hide().fadeIn(2000);

                }else if(e=="unselected"){

                    $("#wait").css("display","none");
                    $("#assign").removeAttr('disabled');


                    $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i>Privilege assignment failed. No user category was selected</span></div>");
                    $("#confirmation").hide().fadeIn(2000);

               }


            }
        });
    }
        return false;

    });
</script>
@endsection