@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <div class="panel panel-default">
                @if($offers->status == 1)
<span style="float:right;padding-right: 50px;padding-top: 2px"><a href="{{route('publish_offer', $offers->id)}}" class="form-control btn btn-primary pull-right" style="background-color: green">Published</a></span>
@else
<span style="float:right;padding-right: 50px;padding-top: 2px"><a href="{{route('publish_offer', $offers->id)}}" class="form-control btn btn-warning pull-right">Unpublished</a></span>
@endif
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                         <form method="POST" enctype="multipart/form-data" class="well">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p>
        <input type="text" name="title" placeholder="Title *" class="form-control" value="{{$offers->title}}">
    </p>
    <p>
        <textarea type="text" name="content" placeholder="Description" class="form-control" value="{{$offers->content}}">{{$offers->content}}</textarea>
    </p>
<p>
        <b>Choose Category</b>
    </p>
    <p>
       
                        <select class="form-control" name="cat_id"  >
                            <option value="1">Clean</option>
                            <option value="2">Shop</option>
                            <option value="3">Fix</option>


                        </select>
    </p>
<p>
    <p>
        <b>Enter Price In L.L</b>
    </p>
     <p>
                        <input type="text" name="price" placeholder="price *" class="form-control" value="{{$offers->price}}">
                    </p>    
<p>
        <b>
            Choose a photo/s
        </b>
    </p>
    <p>
        <input type="file" name="attachments[]"  class="form-control" multiple/>
    </p>
    <p>
    @foreach($galleries as $gallery)
  <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
           
                <span class="pull-right">
@if($gallery->img_name == $offers->image_url_original)
               <i class="fa fa-check text-success" aria-hidden="true" title=" Main Image" style="color: #2ab27b"></i>
@else
                <a href="{{route('main_article', $gallery->img_name)}}">  <i class="fa fa-plus" aria-hidden="true" title="Make Main Image" style="color: #bf5329"></i></a>
@endif
                </span>
            </div>
            <div class="panel-body" style="height:120px; background: url('$gallery->img_name}}'); background-size: cover; background-position: center center;background-repeat: no-repeat;">
                
            </div>
            <div class="panel-footer text-center">
            @if($gallery->img_name == $offers->image_url_original)
                <button  class="btn btn-success form-control" title="thi is Main image please set onther main image to delete this one!!" >Main image</buton>
                @else
                <a href="{{route('delete_image' ,  $gallery->id )}}" class="btn btn-danger form-control">Delete</a>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    </p>
    <p>
        <input type="submit" value="Update" class="btn btn-primary form-control">
    </p>

    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
