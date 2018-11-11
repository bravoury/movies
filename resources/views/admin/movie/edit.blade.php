    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#movie" data-toggle="tab">{!! trans('movies::movie.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#movies-movie-edit'  data-load-to='#movies-movie-entry' data-datatable='#movies-movie-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#movies-movie-entry' data-href='{{trans_url('admin/movies/movie')}}/{{$movie->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('movies-movie-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(URL::to('admin/movies/movie/'. $movie->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="movie">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('movies::movie.name') !!} [{!!$movie->name!!}] </div>
                @include('movies::admin.movie.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>