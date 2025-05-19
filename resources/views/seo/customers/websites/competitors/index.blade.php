<x-app-layout
    :active-page="'seo_index_website_competitors'"
    :css="asset('css/seo/customers/websites/competitors/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{trans_choice('competitor.competitor', 2)}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeCompetitor'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeCompetitor'] }}
                        </div>
                    @endif
                    <x-nav-link class="ml-0 p-0 pr-md-2" :href="route('seo.customers.competitors.create', ['customer' => $customer_id])" :active="request()->routeIs('seo.customers.competitors.create', ['customer' => $customer_id])" aria-label="{{__('title.add_competitor')}}" title="{{__('title.add_competitor')}}">
                        <i class="fas fa-plus fa-2x"></i>
                    </x-nav-link>
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
                                <div class="d-flex align-items-center">
                                    <div class="w-100" title="{{trans_choice('competitor.competitor', 1)}}">{{$competitor->url}}</div>
                                    <x-nav-link class="ml-2 p-0" :href="route('seo.customers.competitors.edit', ['customer' => $customer_id, 'competitor' => $competitor->id])" :active="request()->routeIs('seo.customers.competitors.edit', ['customer' => $customer_id, 'competitor' => $competitor->id])" aria-label="{{__('title.edit_competitor')}}" title="{{__('title.edit_competitor')}}">
                                        <i class="fas fa-edit fa-2x"></i>
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
