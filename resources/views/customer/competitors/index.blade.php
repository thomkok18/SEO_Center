<x-app-layout
    :active-page="'customer_index_competitors'"
    :css="asset('css/customer/competitors/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-0">{{trans_choice('competitor.competitor', 2)}}</h3>
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
                        @forelse($competitors as $competitor)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-inline-block d-sm-flex align-items-center">
                                    <div class="w-100" title="{{trans_choice('competitor.competitor', 1)}}">{{$competitor->url}}</div>
                                    <x-nav-link class="ml-0 ml-xl-2 p-0 pr-md-2" :href="route('customer.competitors.show', ['competitor' => $competitor->id])" :active="request()->routeIs('customer.competitors.show', ['id' => $competitor->id])" aria-label="{{trans_choice('competitor.competitor', 1)}}" title="{{trans_choice('competitor.competitor', 1)}}">
                                        <i class="fas fa-address-book fa-2x"></i>
                                    </x-nav-link>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.competitors_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$competitors->isEmpty()) class="mt-2"> {{$competitors->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
