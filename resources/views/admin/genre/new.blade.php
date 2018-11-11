<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">  {!! trans('movies::genre.names') !!} [{!! trans('movies::genre.text.preview') !!}]</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm"  data-action='NEW' data-load-to='#movies-genre-entry' data-href='{!!trans_url('admin/movies/genre/create')!!}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }} </button>
        </div>
    </div>
</div>