<div class="container">
    <h1> Genres</h1>

    <div class="row">
        <div class="col-md-8">
            @forelse($genres as $genre)
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $genre['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('movies') }}/{!! $genre->getPublicKey() !!}" class="btn btn-default pull-right"> {{ trans('app.details')  }}</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="id">
                    {!! trans('movies::genre.label.id') !!}
                </label><br />
                    {!! $genre['id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="movie_id">
                    {!! trans('movies::genre.label.movie_id') !!}
                </label><br />
                    {!! $genre['movie_id'] !!}
            </div>
        </div>
    </div>
            </div>
            @empty
            <div class="card-box">
                <p class="text-muted m-b-25 font-13">
                    Your search for <b>'{{Request::get('search')}}'</b> returned empty result.
                </p>
            </div>
            @endif
            {{$movies->render()}}
        </div>
        <div class="col-md-4">
            @include('movies::public.genre.aside')
        </div>
    </div>
</div>