<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">  {!! trans('movies::movie.names') !!} [{!! trans('movies::movie.text.preview') !!}]</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm"  data-action='NEW' data-load-to='#movies-movie-entry' data-href='{!!trans_url('admin/movies/movie/create')!!}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }} </button>
        </div>
    </div>
</div>