<x-app-layout
    :active-page="'customer_index_promotion_urls'"
    :css="asset('css/customer/promotion-urls/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="m-0">{{ $website->url }}</h3>
                    <h4 class="mt-0">{{ __('webpage.promotion_url') }}</h4>
                </div>

                <div class="card-body">
                    <form class="w-100" method="GET" action="{{ route('customer.promotion-urls.search', ['website' => $website->id]) }}">
                        @csrf
                        <div class="d-lg-flex align-items-center">
                            <div class="form-group mb-lg-0 mr-lg-2">
                                <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_promotion_url')}}" autofocus/>
                            </div>
                            <div class="form-group mb-lg-0 mr-lg-2">
                                <select id="url_type_id" class="form-control" name="url_type_id" title="{{__('title.filter_promotion_url_type')}}" autofocus>
                                    <option value="">{{__('form.all_url_types')}}</option>
                                    @foreach($urlTypes as $urlType)
                                        <option value="{{$urlType->id}}"
                                            @if($urlType->id === intval(request('url_type_id')))
                                                selected
                                            @endif
                                        >{{trans_choice('title.' . $urlType->name, 2)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 p-0">
                        @forelse($promotionUrls as $promotionUrl)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-xl-flex align-items-center">
                                    <div class="w-100" title="{{__('promotionUrl.promotion_url')}}">
                                        <a href="{{$promotionUrl->promotion_url}}" target="_blank" rel="noopener noreferrer">{{$promotionUrl->promotion_url}}</a>
                                    </div>
                                    <div class="w-100" title="{{__('promotionUrl.url_type_id')}}">{{$promotionUrl->name}}</div>
                                    <div class=" d-xl-flex justify-content-end w-100" title="{{__('title.active_since')}}">
                                        {{date_format(date_create($promotionUrl->measured_at), 'd-m-Y h:m')}}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.promotion_urls_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$promotionUrls->isEmpty()) class="mt-2"> {{$promotionUrls->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
