    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('movies::movie.name') !!}</a></li>
            <div class="box-tools pull-right">
                @include('movies::admin.movie.partial.workflow')
                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#movies-movie-entry' data-href='{{trans_url('admin/movies/movie/create')}}'><i class="fa fa-times-circle"></i> {{ trans('app.new') }}</button>
                @if($movie->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#movies-movie-entry' data-href='{{ trans_url('/admin/movies/movie') }}/{{$movie->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#movies-movie-entry' data-datatable='#movies-movie-list' data-href='{{ trans_url('/admin/movies/movie') }}/{{$movie->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('movies-movie-show')
        ->method('POST')
        ->files('true')
        ->action(URL::to('admin/movies/movie'))!!}
            <div class="tab-content clearfix">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('movies::movie.name') !!}  [{!! $movie->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('movies::admin.movie.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>