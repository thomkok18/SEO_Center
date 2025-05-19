<x-app-layout
    :active-page="'seo_index_customer'"
    :css="asset('css/seo/customers/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.customers') }}</h3>
                </div>
                <div class="card-body">
                    @if (session('status')['storeAccount'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeAccount'] }}
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link class="ml-0 p-0 pr-md-2" :href="route('seo.customers.create')" :active="request()->routeIs('seo.customer.create')" aria-label="{{__('title.add_customer')}}" title="{{__('title.add_customer')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                        </div>
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
                        @forelse($customers as $customer)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="w-100 mr-2" title="{{__('role.customer')}}">{{$customer->name}}</div>
                                    <x-nav-link class="mr-2 p-0" :href="route('seo.customers.edit', ['customer' => $customer->id])" :active="request()->routeIs('seo.customer.edit', ['id' => $customer->id])" aria-label="{{__('title.edit_company')}}" title="{{__('title.edit_company')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                    <x-nav-link class="mr-2 p-0" :href="route('seo.customers.competitors.index', ['customer' => $customer->id])" :active="request()->routeIs('seo.competitors.index', ['customer' => $customer->id])" aria-label="{{trans_choice('competitor.competitor', 2)}}" title="{{trans_choice('competitor.competitor', 2)}}">
                                        <i class="fas fa-trophy fa-2x"></i>
                                    </x-nav-link>
                                    <x-nav-link class="mr-2 p-0" :href="route('seo.customers.websites.index', ['customer' => $customer->id])" :active="request()->routeIs('seo.customers.websites.index', ['customer' => $customer->id])" aria-label="{{trans_choice('promotionUrl.customer_website', 2)}}" title="{{trans_choice('promotionUrl.customer_website', 2)}}">
                                        <i class="fas fa-address-book fa-2x"></i>
                                    </x-nav-link>
                                    <x-nav-link class="p-0" :href="route('seo.customers.mailto.index', ['customer' => $customer->id])" :active="request()->routeIs('seo.customers.mailto.index', ['customer' => $customer->id])" aria-label="{{__('title.add_mailto')}}" title="{{__('title.add_mailto')}}">
                                        <i class="fas fa-mail-bulk fa-2x"></i>
                                    </x-nav-link>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.companies_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$customers->isEmpty()) class="mt-2"> {{$customers->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
