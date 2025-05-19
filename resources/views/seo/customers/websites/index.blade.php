<x-app-layout
    :active-page="'seo_index_website'"
    :css="asset('css/seo/customers/websites/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ trans_choice('promotionUrl.customer_website', 2) }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeWebsite'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeWebsite'] }}
                        </div>
                    @endif
                    @if (session('status')['updateWebsite'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateWebsite'] }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <x-nav-link :href="route('seo.customers.websites.create', ['customer' => $customer_id])" class="p-0 py-2 pr-3" :active="request()->routeIs('seo.customers.websites.create', ['customer' => $customer_id])" aria-label="{{__('title.add_website')}}" title="{{__('title.add_website')}}">
                            <i class="fas fa-plus fa-2x"></i>
                        </x-nav-link>
                        <div>
                            <a href="{{route('seo.customers.websites.archived', $customer_id)}}" aria-label="{{__('title.archived_website')}}" title="{{__('title.archived_website')}}">
                                <i class="fas fa-book fa-2x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @forelse($websites as $website)
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white shadow mb-2 p-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-content-center justify-content-between">
                                    <div>
                                        <div title="{{__('website.url')}}">{{$website->url}}</div>
                                        <div title="{{__('title.customer_budget_left')}}">€ {{$website->budget_amount}}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <x-nav-link class="p-0" :href="route('seo.customers.websites.show', ['customer' => $customer_id, 'website' => $website->id])" :active="request()->routeIs('seo.customers.websites.show', ['customer' => $customer_id, 'website' => $website->id])" aria-label="{{__('title.website_budget_overview')}}" title="{{__('title.website_budget_overview')}}">
                                            <i class="fas fa-money-check-alt fa-2x"></i>
                                        </x-nav-link>
                                        <x-nav-link class="ml-2 p-0" :href="route('seo.customers.websites.edit', ['customer' => $customer_id, 'website' => $website->id])" :active="request()->routeIs('seo.customers.websites.edit', ['customer' => $customer_id, 'website' => $website->id])" aria-label="{{__('title.edit_website')}}" title="{{__('title.edit_website')}}">
                                            <i class="fas fa-edit fa-2x"></i>
                                        </x-nav-link>
                                        <div>
                                            @if(new DateTime(\App\Models\Budget::getRecentBudgetByWebsiteId($website->id)->date) > now())
                                                <a class="ml-2" aria-label="{{__('title.delete_website')}}" href="#" title="{{__('title.delete_website')}}">
                                                    <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$website->id}}"></i>
                                                </a>
                                                <x-modal
                                                    :id="$website->id"
                                                    :title="$website->url"
                                                    :description="__('modal.delete_message', ['item' => $website->url])"
                                                    :route="route('seo.customers.websites.destroy', $customer_id, $website->id)"
                                                    :method="'DELETE'"
                                                ></x-modal>
                                            @else
                                                <form class="w-100" method="POST" action="{{ route('seo.customers.websites.archive', ['website' => $website->id]) }}">
                                                    @csrf
                                                    <a aria-label="Archive website" class="ml-2 p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.archive_website')}}">
                                                        <i class="fas fa-archive fa-2x"></i>
                                                    </a>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm p-2">
                    {{__('pagination.websites_not_found')}}
                </div>
            @endforelse
            <div
                @if(!$websites->isEmpty()) class="mt-2"> {{$websites->links()}} @else > @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Opening and closing a modal.
        (function () {
            if (navigator.platform.startsWith('Win')) {
                $('.modal').on('show.bs.modal', () => {}).on('hide.bs.modal', () => {
                    @foreach($websites as $index => $website)
                        const ps_{{$index}} = new PerfectScrollbar('#modal-{{$website->id}}');
                        ps_{{$index}}.destroy();
                    @endforeach
                });
            }
        });
    </script>
</x-app-layout>
