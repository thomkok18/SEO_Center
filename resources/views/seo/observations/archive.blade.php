<x-app-layout
    :active-page="'seo_archive_observations'"
    :css="asset('css/seo/observations/archive.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.archive')}}</h3>
                </div>

                <div class="card-body">
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
                                <div class="d-flex align-items-center">
                                    <div class="w-100" title="{{__('observation.name')}}">{{$observation['name_' . auth()->user()->language->code] ? $observation['name_' . auth()->user()->language->code] : $observation['name_en']}}</div>
                                    <form class="ml-2 p-0" method="POST" action="{{ route('seo.observations.recover', ['observation' => $observation->id]) }}">
                                        @csrf
                                        <a class="p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.recover_observation')}}">
                                            <i class="fas fa-undo-alt fa-2x"></i>
                                        </a>
                                    </form>
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
</x-app-layout>
