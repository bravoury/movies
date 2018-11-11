    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Genre</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#movies-genre-create'  data-load-to='#movies-genre-entry' data-datatable='#movies-genre-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#movies-genre-entry' data-href='{{trans_url('admin/movies/genre/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        <div class="tab-content clearfix">
            {!!Form::vertical_open()
            ->id('movies-genre-create')
            ->method('POST')
            ->files('true')
            ->action(URL::to('admin/movies/genre'))!!}
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {{ trans('app.new') }}  [{!! trans('movies::genre.name') !!}] </div>
                @include('movies::admin.genre.partial.entry')
            </div>
            {!! Form::close() !!}
        </div>
    </div>