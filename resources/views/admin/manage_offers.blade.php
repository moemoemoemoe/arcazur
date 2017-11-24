@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Offers</div>

                <div class="panel-body">
                                   
 <div class="row">
                                                            
@foreach($offers as $offer)
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading text-center">
           
                <b>{{$offer->title}}</b> 
                <span class="pull-right">

                @if($offer->status == 1)
              <a href="{{route('publish_offer', $offer->id)}}">   <i class="fa fa-check text-success" title="Active .. press to unpublish"></i></a>
@else              <a href="{{route('publish_offer', $offer->id)}}">  <i class="fa fa-times-circle" aria-hidden="true" title="Not Active..please publish it on click"></i></a>
@endif
                </span>
            </div>
            <div class="panel-body" style="height:150px ; background: url('{{$offer->image_url_original}}'); background-size: cover; background-position: center center;background-repeat: no-repeat;">
                
            </div>
            <div class="panel-footer text-center">
                <a href="{{route('view_offer', $offer->id)}}" class="btn btn-primary form-control">More...</a>
            </div>
        </div>
    </div>

    @endforeach
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
