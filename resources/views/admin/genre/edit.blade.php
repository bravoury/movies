    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#genre" data-toggle="tab">{!! trans('movies::genre.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#movies-genre-edit'  data-load-to='#movies-genre-entry' data-datatable='#movies-genre-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#movies-genre-entry' data-href='{{trans_url('admin/movies/genre')}}/{{$genre->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('movies-genre-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(URL::to('admin/movies/genre/'. $genre->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="genre">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('movies::genre.name') !!} [{!!$genre->name!!}] </div>
                @include('movies::admin.genre.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>