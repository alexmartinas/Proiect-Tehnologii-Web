@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">         <!--  name, age, gen, nr telefon-->
                    <div class="panel-heading">Add existing child</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('add-existing-child') }}">
                            {{ csrf_field() }}

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
