<x-app-layout
    :active-page="'seo_index_observations'"
    :css="asset('css/seo/observations/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.observations') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeObservation'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeObservation'] }}
                        </div>
                    @endif
                    @if (session('status')['destroyObservation'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['destroyObservation'] }}
                        </div>
                    @endif
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
                        <div class="d-flex">
                            <x-nav-link :href="route('seo.observations.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('seo.observations.create')" aria-label="{{__('title.add_observation')}}" title="{{__('title.add_observation')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('seo.observations.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_observation')}}" autofocus/>
                                </div>
                                <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 p-0">
                        @forelse($observations as $observation)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="w-100 mr-2" title="{{__('observation.name')}}">{{$observation['name_' . auth()->user()->language->code] ? $observation['name_' . auth()->user()->language->code] : $observation['name_en']}}</div>
                                    <x-nav-link class="mr-2 p-0" :href="route('seo.observations.edit', ['observation' => $observation->id])" :active="request()->routeIs('seo.observations.edit', ['observation' => $observation->id])" aria-label="{{__('title.edit_observation')}}" title="{{__('title.edit_observation')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>

                                    @if(\App\Models\ObservationCheck::where('observation_id', '=', $observation->id)->exists())
                                        <form method="POST" action="{{ route('seo.observations.archive', ['observation' => $observation->id]) }}">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.archive_observation')}}">
                                                <i class="fas fa-archive fa-2x"></i>
                                            </a>
                                        </form>
                                    @else
                                        <a class="d-flex justify-content-center" style="width: 30px" href="#" title="{{__('title.delete_observation')}}">
                                            <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$observation->id}}"></i>
                                        </a>
                                        <x-modal
                                            :id="$observation->id"
                                            :title="$observation['name_' . auth()->user()->language->code]"
                                            :description="__('modal.delete_message', ['item' => $observation['name_' . auth()->user()->language->code]])"
                                            :route="route('seo.observations.destroy', $observation->id)"
                                            :method="'DELETE'"
                                        ></x-modal>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.observations_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$observations->isEmpty()) class="mt-2"> {{$observations->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Opening and closing a modal.
        (function () {
            if (navigator.platform.startsWith('Win')) {
                $('.modal').on('show.bs.modal', () => {}).on('hide.bs.modal', () => {
                    @foreach($observations as $index => $observation)
                        const ps_{{$index}} = new PerfectScrollbar('#modal-{{$observation->id}}');
                        ps_{{$index}}.destroy();
                    @endforeach
                });
            }
        });
    </script>
</x-app-layout>
