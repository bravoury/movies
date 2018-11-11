<div class="container">
    <h1> Movies</h1>

    <div class="row">
        <div class="col-md-8">
            @forelse($movies as $movie)
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-dark  header-title m-t-0"> {!! $movie['name'] !!} </h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ trans_url('movies') }}/{!! $movie->getPublicKey() !!}" class="btn btn-default pull-right"> {{ trans('app.details')  }}</a>
                    </div>
                </div>
                <hr/>

                <div class="row">
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="id">
                    {!! trans('movies::movie.label.id') !!}
                </label><br />
                    {!! $movie['id'] !!}
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class"form-group">
                <label for="title">
                    {!! trans('movies::movie.label.title') !!}
                </label><br />
                    {!! $movie['title'] !!}
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
            @include('movies::public.movie.aside')
        </div>
    </div>
</div>