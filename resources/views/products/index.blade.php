@extends('layouts.app')

@section('styles')
@endsection

@section('title') 
    PRODUCTS
@endsection 

@section('subtitle') 
  PRODUCTS MODULE
@endsection 

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('products.index')}}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Index</li>
@endsection

@section('content')
{!! Form::open(['method'=>'GET', 'action'=> 'App\Http\Controllers\ProductController@index','class'=>'form','id'=>'search','style'=>'display:none;']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\ProductController@update_products','class'=>'form','id'=>'update','style'=>'display:none;']) !!}
{!! Form::close() !!} 

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\ProductController@store','class'=>'form','id'=>'store']) !!}
{!! Form::close() !!}

{!! Form::open(['method'=>'POST', 'action'=> 'App\Http\Controllers\ProductController@delete_product','class'=>'form','id'=>'delete']) !!}
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
                    <th scope="col">CATEGORY</th>
                    <th scope="col" style="text-align:center;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($products))
                    @foreach($products as $product)
                    @if($product->id % 2)
                        <tr class="table-primary">
                    @else
                        <tr class="table-secondary">
                    @endif
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->Category->category_name}}</td>
                            <td style="text-align:center;">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="editVas('{{$product->product_uuid}}','{{$product->product_name}}','{{$product->category_id}}')" style="background-color:transparent; border:none;">
                                    <i class="fas fa-edit" style="color:#ff7b24;"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="deleteVas('{{$product->product_uuid}}')" style="background-color:transparent; border:none;">
                                  <i class="fas fa-trash" style="color:#ff2424;"></i>
                              </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{$products->render()}}
    </div>


<!-- Modal CAT CREATE-->
<div class="modal fade" id="modalCat" tabindex="-1" role="dialog" aria-labelledby="modalCatCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalCatLongTitle" style="font-size:16px;">PRODUCT CREATION</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">
                    {!! Form::label('product_name', 'PRODUCT NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::text('product_name', null, ['class'=>'form-control','form'=>'store'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'CATEGORY NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::select('category_id',  $categories, null, ['class'=>'form-control','form'=>'store'])!!}
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('SAVE PRODUCT',['class'=>'btn btn-success','form'=>'store','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
      </div>
    </div>
  </div>
</div>


<!-- Modal PRODUCTS UPDATE-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalCategoryEditCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalCategoryEditLongTitle" style="font-size:16px;">PRODUCT UPDATE</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class="col-sm-12 ">
                <div class="form-group">
                    {!! Form::label('product_name', 'PRODUCT NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::hidden('product_id', '', ['form'=>'update','id'=>'update_id'])!!}
                    {!! Form::text('product_name', null, ['class'=>'form-control','form'=>'update','id'=>'product_name_update'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_id', 'CATEGORY NAME:',['style'=>'font-weight:bold;']) !!}
                    {!! Form::select('category_id',  $categories, null, ['class'=>'form-control','form'=>'update','id'=>'category_post'])!!}
                </div>
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('UPDATE PRODUCT',['class'=>'btn btn-success','form'=>'update','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
      </div>
    </div>
  </div>
</div>

<!-- LOADING -->
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

<!-- Modal Delete-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold badge bg-primary" id="modalDeleteLongTitle" style="font-size:16px;">PLEASE WAIT</h5>
      </div>
      <div class="modal-body">
        <div class='row'>
          <div class="col-sm-12">
            {!! Form::hidden('product_id', '', ['form'=>'delete','id'=>'delete_id'])!!}
            <p class="text-center" style="font-weight:bold;">ARE YOU SURE YOU WANT TO DELETE THIS PRODUCT?</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
        {!! Form::submit('DELETE PRODUCT',['class'=>'btn btn-success','form'=>'delete','data-bs-toggle'=>'modal','data-bs-target'=>'#modalManual2'])!!}
        
      </div>
    </div>
  </div>
</div>


@endsection

@section('scripts')
<script>
    function editVas(id,product_name,category_id){
        let product_id = id;
        let product_name_post = product_name;
        let category_post = category_id;
        document.getElementById("update_id").value = product_id;
        document.getElementById("product_name_update").value = product_name_post;
        //document.getElementById("category_id").value = category_post;
        // $('#category_id').val(category_post);
        $("#category_post").val(category_post).change();
    }
    function deleteVas(id){
      let delete_id = id;
      document.getElementById("delete_id").value = delete_id;
    }
</script>
@endsection