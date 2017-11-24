@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Upload New Offer</div>

                <div class="panel-body">
                 <form method="POST" enctype="multipart/form-data" class="well">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <p>
                        <input type="text" name="title" placeholder="Title *" class="form-control" value="{{old('title')}}">
                    </p>
                    <p>
                        <textarea type="text" name="content" placeholder="Description" class="form-control" value="{{old('content')}}"></textarea>
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
        <b>Enter Price In L.L</b>
    </p>
                 <p>
                        <input type="text" name="price" placeholder="price *" class="form-control" value="{{old('price')}}">
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
                    <input type="submit" value="Save" class="btn btn-primary form-control">
                </p>

            </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection
