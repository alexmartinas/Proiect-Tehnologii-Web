@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">         <!--  name, age, gen, nr telefon-->
                    <div class="panel-heading">Add child</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('add-child') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('device_id') ? ' has-error' : '' }}">
                                <label for="device_id" class="col-md-4 control-label">Device id</label>

                                <div class="col-md-6">
                                    <input id="device_id" type="text" class="form-control" name="device_id"  value="{{ old('device_id') }}" required>

                                    @if ($errors->has('device_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('device_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Age</label>

                                <div class="col-md-6">
                                    <input id="age" type="number" class="form-control" name="age" min="1" max="17" value="{{ old('age') }}" required>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">
                                        <input type="radio" name="gender" value="male" checked> Male<br>
                                        <input type="radio" name="gender" value="female"> Female<br>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add
                                    </button>
                                </div>
                            </div>

                            @if($message!='Ok')
                                <div class="alert alert-danger">{{$message}}</div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<style type="text/css">
    .panel.panel-default {
        background-color: rgba(255, 255, 255, 0.7)
    }
    @media (min-width:769px) {
        .panel.panel-default {
            position: fixed;
            top: 50%;
            left: 50%;
            bottom: 0;
            width: 600px;
            height: 412px;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
        }
        #app .panel-heading {
            text-align: center;
            padding-top: 6px;
            padding-bottom: 0;
            border: 1px solid #ccc;
            font-size: 30px;
            font-weight: 900;
        }
    }
</style>