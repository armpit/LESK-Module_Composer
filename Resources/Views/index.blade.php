@extends('layouts.master')

@section('head_extra')
@endsection

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('composer::general.page.index.box-title') }}</h3>
                </div>

                <div class="box-body">

                    <div class="form-group">

                        <b>PHP Version: </b> {{ $data['platform']['php'] }}<br />
                        <b>Prefer Stable: </b>
                        @if($data['prefer-stable'] == 1)
                            True<br />
                        @else
                            False<br />
                        @endif
                        <b>Prefer Lowest: </b>
                        @if($data['prefer-lowest'] == 1)
                            True<br />
                        @else
                            False<br />
                        @endif
                        <br />

                    </div><!-- /.form-group -->

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->



    <div class='row'>
        <div class='col-md-12'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('composer::general.page.index.packages') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">

                    <div class="form-group">

        <table width="90%">
            @foreach($data['packages'] as $package)
                <tr>
                    <td width="60%"><a href="composer/show/{{ $package['pkg_id'] }}">{{ $package['name'] }}</a></td>
                    <td>{{ $package['version'] }}</td>
                </tr>
                <tr style="border-bottom: 1px #000 solid;">
                    <td colspan="2">
                        @if(isset($package['description']) && $package['description'] != '')
                            {{ $package['description'] }}
                        @else
                            &nbsp;
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>

                    </div><!-- /.form-group -->

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->




    <div class='row'>
        <div class='col-md-12'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('composer::general.page.index.packages-dev') }}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>

                <div class="box-body">

                    <div class="form-group">

                        <table width="90%">
                            @foreach($data['packages-dev'] as $package)
                                <tr>
                                    <td width="60%"><a href="composer/show/{{ $package['pkg_id'] }}">{{ $package['name'] }}</a></td>
                                    <td>{{ $package['version'] }}</td>
                                </tr>
                                <tr style="border-bottom: 1px #000 solid;">
                                    <td colspan="2">
                                        @if(isset($package['description']) && $package['description'] != '')
                                            {{ $package['description'] }}
                                        @else
                                            &nbsp;
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div><!-- /.form-group -->

                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection


<!-- Optional bottom section for modals etc... -->
@section('body_bottom')
@endsection
