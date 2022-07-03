@extends('layouts.app')

@section('styles')
@endsection

@section('title') 
    USER MODULE
@endsection 

@section('subtitle') 
    USER INDEX
@endsection 

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
@endsection

@section('content')
{!! Form::open(['method'=>'GET', 'action'=> 'App\Http\Controllers\UserController@index','class'=>'form','id'=>'search_user','style'=>'display:none;']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\UserController@store','class'=>'form','id'=>'create_user','enctype' => 'multipart/form-data']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\UserController@update_user','class'=>'form','id'=>'update_user','style'=>'display:none;','enctype' => 'multipart/form-data']) !!}
{!! Form::close() !!}

    <div class="row">         
        @include('includes.form_error')
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-3">
            <div class="form-group">
                {!! Form::label('search', 'SEARCH:',['style'=>'font-weight:bold;']) !!}
                {!! Form::text('search',$search, ['class'=>'form-control','form'=>'search_user'])!!}
            </div>
        </div>
        <div class="col-md-12  col-lg-2 style-top">
            {!! Form::label('-', '-',['style'=>'font-weight:bold;color:white;']) !!}
            {!! Form::submit('SEARCH',['class'=>'btn btn-secondary btn-block','form'=>'search_user'])!!}
        </div>
        <div class="col-md-12 col-lg-5">

        </div>
        <div class="col-md-12 col-lg-2 style-top">
             {!! Form::label('-', '-',['style'=>'font-weight:bold;color:white']) !!}
            <button type="button" class="btn btn-success btn-block" data-bs-toggle="modal"
                data-bs-target="#modalUser">
                <span class="fas fa-plus"></span>
                ADD USER
            </button>
        </div>
    </div>

    <hr>
    <div class="table-responsive mt-2">
    <!-- Projects table -->
    <table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" style="text-align:center;">ACTION</th>
            <th scope="col" class="text-center">USER DETAIL</th>
            <th scope="col" style="text-align:center;">ADMIN</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($users))
            @foreach($users as $user)
            @if($user->id % 2)
                <tr class="table-primary">
            @else
                <tr class="table-secondary">
            @endif  
                    <td style="text-align:center;">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="editUser({{$user->id}},'{{$user->name}}','{{$user->email}}','{{$user->is_admin}}')" style="background-color:transparent; border:none;">
                        <i class="fas fa-edit" style="color:#ff7b24;"></i>
                        </button>
                    
                    </td>
                   
                    <td class="text-center">
                        <span class="badge bg-primary">{{$user->name}}</span><br>
                        <span class="badge bg-secondary">{{$user->email}}</span><br>
                    </td>
                   
         
                    @if($user->is_admin=='1')
                    <td style="text-align:center;"><span class="badge bg-success"><i class="fas fa-check"></i></span></td>
                    @else
                    <td style="text-align:center;"><span class="badge bg-danger"><i class="fas fa-times"></i></span></td>
                    @endif

 
                    
                </tr> 
            @endforeach
        @endif
    </tbody>
    </table>
    {{$users->render()}}

</div>


<!-- Modal USER CREATE-->
<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalUserCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalUserLongTitle" style="font-size:16px;">USER CREATION</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">
                    {!! Form::label('email', 'EMAIL:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::email('email', null, ['class'=>'form-control','form'=>'create_user'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', 'NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::text('name', null, ['class'=>'form-control','form'=>'create_user'])!!}
                </div>
             
                <div class="form-group">
                    {!! Form::label('password', 'PASSWORD:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::password('password', ['class'=>'form-control','form'=>'create_user'])!!}
                </div>

                <div class="form-group">
                    {!! Form::label('PRIVILEGES', 'PRIVILEGES',['style'=>'text-align:center; font-weight:bold;']) !!}
                    <table class="table">
                        <thead>
                            <th></th>
                            <th class="text-center">YES</th>
                            <th class="text-center">NO</th>
                        </thead>
                        
                        <tbody>
                           
                            <tr>
                                <td class="text-left">ADMIN</td>
                                <td class="text-center">{!! Form::radio('is_admin','1', false,['form'=>'create_user'])!!} </td>
                                <td class="text-center">{!! Form::radio('is_admin','0', true,['form'=>'create_user'])!!}</td>
                            </tr>
                
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('SAVE USER',['class'=>'btn btn-success','form'=>'create_user','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
      </div>
    </div>
  </div>
</div>


<!-- Modal USER EDIT-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalEditLongTitle" style="font-size:16px;">USER UPDATE</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">

                    {!! Form::label('email_update', 'EMAIL:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::hidden('user_id', '', ['form'=>'update_user','id'=>'update_id'])!!}
                    {!! Form::email('email_update', null, ['class'=>'form-control','form'=>'update_user','id'=>'update_email'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('name_update', 'NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::text('name_update', null, ['class'=>'form-control','form'=>'update_user','id'=>'update_name'])!!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password_update', 'PASSWORD:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::password('password_update', ['class'=>'form-control','form'=>'update_user'])!!}
                </div>

                
                <div class="form-group">
                    {!! Form::label('PRIVILEGES', 'PRIVILEGES',['style'=>'text-align:center; font-weight:bold;']) !!}
                    <table class="table">
                        <thead>
                            <th></th>
                            <th class="text-center">YES</th>
                            <th class="text-center">NO</th>
                        </thead>
                        
                        <tbody>
                        
                            <tr>
                                <td class="text-left">ADMIN</td>
                                <td class="text-center">{!! Form::radio('is_admin_update','1', false,['form'=>'update_user','id'=>'check_admin'])!!} </td>
                                <td class="text-center">{!! Form::radio('is_admin_update','0', true,['form'=>'update_user','id'=>'uncheck_admin'])!!}</td>
                            </tr>
              
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('UPDATE USER',['class'=>'btn btn-success','form'=>'update_user','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
      </div>
    </div>
  </div>
</div>

<!-- Modal Update-->
<div class="modal fade" id="modalManual2" tabindex="-1" role="dialog" aria-labelledby="modalManual2CenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold badge bg-primary" id="modalManual2LongTitle" style="font-size:16px;">PLEASE WAIT</h5>
        </div>
        <div class="modal-body">
          <div class='row'>
            <div class="col-sm-12">
                <img src="{{asset('assets/images/gif_sent-dribble.gif')}}" style="width:100%">
            </div>
          </div>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    function editUser(id,name,email,is_admin){
        let user_id = id;
        let user_name =  name;
        let user_email=  email;
        let user_admin=  is_admin;
       
        //USER INPUT
        document.getElementById("update_id").value = user_id;
        document.getElementById("update_name").value = user_name;
        document.getElementById("update_email").value = user_email;

        if(user_admin==0){
            document.getElementById("uncheck_admin").checked = true;
            document.getElementById("check_admin").checked = false;
        }else{
            document.getElementById("check_admin").checked = true;
            document.getElementById("uncheck_admin").checked = false;
        }

       
    }
</script>
@endsection
