<x-app-layout
    :active-page="'seo_create_observations'"
    :css="asset('css/seo/observations/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.create_observation') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('observationError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('observationError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.observations.store') }}">
                            @csrf
                            @foreach($languages as $language)
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <x-label for="name_{{$language->code}}">{{__('observation.name')}} ({{strtoupper($language->code)}})</x-label>
                                            <input id="name_{{$language->code}}" class="form-control" type="text" name="name_{{$language->code}}" :value="old('name_{{$language->code}}')" {{$loop->index === 0 ? 'required' : '' }} autofocus/>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
