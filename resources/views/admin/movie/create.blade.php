    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Movie</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#movies-movie-create'  data-load-to='#movies-movie-entry' data-datatable='#movies-movie-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#movies-movie-entry' data-href='{{trans_url('admin/movies/movie/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        <div class="tab-content clearfix">
            {!!Form::vertical_open()
            ->id('movies-movie-create')
            ->method('POST')
            ->files('true')
            ->action(URL::to('admin/movies/movie'))!!}
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {{ trans('app.new') }}  [{!! trans('movies::movie.name') !!}] </div>
                @include('movies::admin.movie.partial.entry')
            </div>
            {!! Form::close() !!}
        </div>
    </div>