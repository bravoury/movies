@extends('admin::curd.index')
@section('heading')
<i class="fa fa-file-text-o"></i> {!! trans('movies::movie.name') !!} <small> {!! trans('app.manage') !!} {!! trans('movies::movie.names') !!}</small>
@stop

@section('title')
{!! trans('movies::movie.names') !!}
@stop

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{!! trans_url('admin') !!}"><i class="fa fa-dashboard"></i> {!! trans('app.home') !!} </a></li>
    <li class="active">{!! trans('movies::movie.names') !!}</li>
</ol>
@stop

@section('entry')
<div id='movies-movie-entry'>
</div>
@stop

@section('tools')
@stop

@section('content')
<table id="movies-movie-list" class="table table-striped data-table">
    <thead class="list_head">
        <th>{!! trans('movies::movie.label.status')!!}</th>
                    <th>{!! trans('movies::movie.label.created_at')!!}</th>
                    <th>{!! trans('movies::movie.label.updated_at')!!}</th>
    </thead>
    <thead  class="search_bar">
        <th>{!! Form::text('date[status]')->raw()!!}</th>
                    <th>{!! Form::text('date[created_at]')->raw()!!}</th>
                    <th>{!! Form::text('date[updated_at]')->raw()!!}</th>
    </thead>
</table>
@stop

@section('script')
<script type="text/javascript">

var oTable;
$(document).ready(function(){
    app.load('#movies-movie-entry', '{!!trans_url('admin/movies/movie/0')!!}');
    oTable = $('#movies-movie-list').dataTable( {
        "bProcessing": true,
        "sDom": 'R<>rt<ilp><"clear">',
        "bServerSide": true,
        "sAjaxSource": '{!! trans_url('/admin/movies/movie') !!}',
        "fnServerData" : function ( sSource, aoData, fnCallback ) {

            $('#movies-movie-list .search_bar input, #movies-movie-list .search_bar select').each(
                function(){
                    aoData.push( { 'name' : $(this).attr('name'), 'value' : $(this).val() } );
                }
            );
            app.dataTable(aoData);
            $.ajax({
                'dataType'  : 'json',
                'data'      : aoData,
                'type'      : 'GET',
                'url'       : sSource,
                'success'   : fnCallback
            });
        },

        "columns": [
            {data :'status'},
            {data :'created_at'},
            {data :'updated_at'},
        ],
        "pageLength": 25
    });

    $('#movies-movie-list tbody').on( 'click', 'tr', function () {

        oTable.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        var d = $('#movies-movie-list').DataTable().row( this ).data();

        $('#movies-movie-entry').load('{!!trans_url('admin/movies/movie')!!}' + '/' + d.id);
    });

    $("#movies-movie-list .search_bar input, #movies-movie-list .search_bar select").on('keyup select', function (e) {
        e.preventDefault();
        console.log(e.keyCode);
        if (e.keyCode == 13 || e.keyCode == 9) {
            oTable.api().draw();
        }
    });
});
</script>
@stop

@section('style')
@stop

