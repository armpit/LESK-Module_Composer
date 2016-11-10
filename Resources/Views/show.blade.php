@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('composer::general.page.show.box-title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group">

                        <a class="btn btn-default btn-sm fa fa-stop-o" href="#" onclick="window.history.back();" title="{{ trans('composer::general.action.back') }}">
                            {{ trans('composer::general.action.back') }}
                        </a>
                        <br /><br />

                        <b>Name: </b>{{ $data['name'] }}<br />
                        <b>Version: </b>{{ $data['version'] }}<br />
                        <b>Authors: </b><br />
                        @foreach($data['authors'] as $author)
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $author['name'] }} ({{ $author['email'] }})&<br />
                        @endforeach

                        <b>Type: </b>{{ $data['type'] }}<br />

                        <b>License: </b>
                        @foreach($data['license'] as $license)
                            {{ $license }}&nbsp;
                        @endforeach
                        <br />

                        <b>Keywords:</b>
                        @foreach($data['keywords'] as $keyword)
                            {{ $keyword }}&nbsp;
                        @endforeach
                        <br /><br />

                        <b>Description:</b><br />
                        {{ $data['description'] }}
                        <br /><br />

                        <b>Source: </b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>Type: </b>{{ $data['source']['type'] }}<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>URL: </b><a href="{{ $data['source']['url'] }}">{{ $data['source']['url'] }}</a><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>Reference: </b>{{ $data['source']['reference'] }}<br />
                        <br />

                        <b>Distribution: </b><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>Type: </b>{{ $data['dist']['type'] }}<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>URL: </b><a href="{{ $data['dist']['url'] }}">{{ $data['dist']['url'] }}</a><br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>Reference: </b>{{ $data['dist']['reference'] }}<br />
                        &nbsp;&nbsp;&nbsp;&nbsp;<b>Shasum: </b>{{ $data['dist']['shasum'] }}<br />
                        <br />

                        <b>Require:</b><br />
                        @foreach($data['require'] as $k => $v)
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $k }} {{ $v }}<br />
                        @endforeach
                        <br />

                        <b>Require Dev:</b><br />
                        @foreach($data['require-dev'] as $k => $v)
                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $k }} {{ $v }}<br />
                        @endforeach
                        <br />

                        <b>Autoload:</b><br />
                        @foreach($data['autoload'] as $autoload)
                            @foreach($autoload as $k => $v)
                                &nbsp;&nbsp;&nbsp;&nbsp;{{ $k }} {{ $v }}<br />
                            @endforeach
                        @endforeach
                        <br />

                    </div><!-- /.form-group -->

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
