@extends('layouts.app')

@section('styles')
@endsection

@section('title') 
    CATEGORY
@endsection 

@section('subtitle') 
    CATEGORY MODULE
@endsection 

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
@endsection

@section('content')
{!! Form::open(['method'=>'GET', 'action'=> 'App\Http\Controllers\CategoryController@index','class'=>'form','id'=>'search','style'=>'display:none;']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\CategoryController@update_category','class'=>'form','id'=>'update','style'=>'display:none;']) !!}
{!! Form::close() !!} 

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\CategoryController@store','class'=>'form','id'=>'store']) !!}
{!! Form::close() !!}

<div class="row">         
    @include('includes.form_error')
</div>

<div class="row">
        <div class="col-md-12 col-lg-3">
            <div class="form-group">
                {!! Form::label('search', 'SEARCH:',['style'=>'font-weight:bold;']) !!}
                {!! Form::text('search',$search, ['class'=>'form-control','form'=>'search'])!!}
            </div>
        </div>
        <div class="col-md-12  col-lg-2 style-top">
            {!! Form::label('-', '-',['style'=>'font-weight:bold;color:white;']) !!}
            {!! Form::submit('SEARCH',['class'=>'btn btn-secondary btn-block','form'=>'search'])!!}
        </div>
        <div class="col-md-12 col-lg-5">

        </div>
        <div class="col-md-12 col-lg-2 style-top">
             {!! Form::label('-', '-',['style'=>'font-weight:bold;color:white']) !!}
            <button type="button" class="btn btn-success btn-block" data-bs-toggle="modal"
                data-bs-target="#modalCat">
                <span class="fas fa-plus"></span>
                ADD
            </button>
        </div>
    </div>

    <hr>
    <div class="table-responsive mt-2">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NAME</th>
                    <th scope="col" style="text-align:center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($categories))
                    @foreach($categories as $category)
                    @if($category->id % 2)
                        <tr class="table-primary">
                    @else
                        <tr class="table-secondary">
                    @endif
                            <td>{{$category->category_name}}</td>
                            <td style="text-align:center;">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="editVas('{{$category->category_uuid}}','{{$category->category_name}}')" style="background-color:transparent; border:none;">
                                    <i class="fas fa-edit" style="color:#ff7b24;"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{$categories->render()}}
    </div>


<!-- Modal CAT CREATE-->
<div class="modal fade" id="modalCat" tabindex="-1" role="dialog" aria-labelledby="modalCatCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalCatLongTitle" style="font-size:16px;">CATEGORY CREATION</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">
                    {!! Form::label('category_name', 'CATEGORY NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::text('category_name', null, ['class'=>'form-control','form'=>'store'])!!}
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('SAVE CATEGORY',['class'=>'btn btn-success','form'=>'store','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
      </div>
    </div>
  </div>
</div>


<!-- Modal CAT UPDATE-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalCategoryEditCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalCategoryEditLongTitle" style="font-size:16px;">CATEGORY UPDATE</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">
                    {!! Form::label('category_name', 'CATEGORY NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::hidden('category_id', '', ['form'=>'update','id'=>'update_id'])!!}
                    {!! Form::text('category_name', null, ['class'=>'form-control','form'=>'update','id'=>'category_name_update'])!!}
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('UPDATE CATEGORY',['class'=>'btn btn-success','form'=>'update','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
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
    function editVas(id,category_name){
        let category_id = id;
        let category_name_post = category_name;

        document.getElementById("update_id").value = category_id;
        document.getElementById("category_name_update").value = category_name_post;

    }
</script>
@endsection