    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('movies::genre.name') !!}</a></li>
            <div class="box-tools pull-right">
                @include('movies::admin.genre.partial.workflow')
                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#movies-genre-entry' data-href='{{trans_url('admin/movies/genre/create')}}'><i class="fa fa-times-circle"></i> {{ trans('app.new') }}</button>
                @if($genre->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#movies-genre-entry' data-href='{{ trans_url('/admin/movies/genre') }}/{{$genre->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#movies-genre-entry' data-datatable='#movies-genre-list' data-href='{{ trans_url('/admin/movies/genre') }}/{{$genre->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('movies-genre-show')
        ->method('POST')
        ->files('true')
        ->action(URL::to('admin/movies/genre'))!!}
            <div class="tab-content clearfix">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('movies::genre.name') !!}  [{!! $genre->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('movies::admin.genre.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>