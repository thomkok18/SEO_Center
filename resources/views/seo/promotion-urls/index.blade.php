<x-app-layout
    :active-page="'seo_index_promotion_urls'"
    :css="asset('css/seo/promotion-urls/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.promotion_url') }}</h3>
                </div>

                <div class="card-body">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-lg-flex align-items-center">
                            <form class="w-100" method="GET" action="{{ route('seo.promotion-urls.search') }}">
                                @csrf
                                <div class="d-lg-flex align-items-center">
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_promotion_url')}}" autofocus/>
                                    </div>
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <select id="url_type_id" class="form-control" name="url_type_id" title="{{__('title.filter_promotion_url_type')}}" autofocus>
                                            <option value="">{{__('form.all_url_types')}}</option>
                                            @foreach($urlTypes as $urlType)
                                                <option value="{{$urlType->id}}" @if($urlType->id === intval(request('url_type_id'))) selected @endif>{{trans_choice('title.' . $urlType->name, 2)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <select id="conclusion_id" class="selectpicker" data-style="btn btn-info btn-round" name="conclusion_ids[]" data-size="10" title="{{__('title.filter_promotion_url_conclusion')}}" multiple required autofocus>
                                            <option value="" @if(!$_GET || $_GET['conclusion_ids'][0] === '') selected @endif>{{__('form.all_conclusion_types')}}</option>
                                            @foreach($conclusions as $conclusion)
                                                <option value="{{$conclusion->id}}"
                                                    @if($_GET)
                                                        @foreach($_GET['conclusion_ids'] as $id)
                                                            @if($conclusion->id === intval($id)) selected @endif
                                                        @endforeach
                                                    @endif
                                                >{{__('conclusion_types.' . $conclusion->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <select id="checked" class="form-control" name="checked" title="{{__('title.filter_promotion_url_checked')}}" autofocus>
                                            <option value="" @if(!$_GET || $_GET['checked'] === '') selected @endif>{{__('promotionUrl.all')}}</option>
                                            <option value="0"
                                                @if($_GET)
                                                    @if($_GET['checked'] === '0')
                                                        selected
                                                    @endif
                                                @endif
                                            >{{__('promotionUrl.never_checked')}}</option>
                                            <option value="1"
                                                @if($_GET)
                                                    @if($_GET['checked'] === '1')
                                                        selected
                                                    @endif
                                                @endif
                                            >{{__('promotionUrl.ever_checked')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <select id="order" class="form-control" name="order" title="{{__('title.filter_promotion_url_order')}}" autofocus>
                                            <option value="desc"
                                                @if($_GET)
                                                    @if($_GET['order'] === 'desc')
                                                        selected
                                                    @endif
                                                @endif
                                            >{{__('promotionUrl.new')}}</option>
                                            <option value="asc"
                                                @if($_GET)
                                                    @if($_GET['order'] === 'asc')
                                                        selected
                                                    @endif
                                                @endif
                                            >{{__('promotionUrl.old')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-lg-0 mr-lg-2">
                                        <select id="alphabetical" class="form-control" name="alphabetical" title="{{__('title.filter_promotion_url_alphabetical')}}" autofocus>
                                            <option value="desc"
                                                @if($_GET)
                                                    @if($_GET['alphabetical'] === 'desc')
                                                        selected
                                                    @endif
                                                @endif
                                            >A-Z</option>
                                            <option value="asc"
                                                @if($_GET)
                                                    @if($_GET['alphabetical'] === 'asc')
                                                        selected
                                                    @endif
                                                @endif
                                            >Z-A</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                                </div>
                            </form>
                        </div>
                        <form method="GET" action="{{ route('seo.promotion-urls.download') }}">
                            @csrf
                            <input type="hidden" name="search" value="{{request('search') ?? ''}}"/>
                            @if($_GET)
                                <input type="hidden" name="url_type_id" value="{{$_GET['url_type_id']}}"/>
                            @endif
                            @if($_GET)
                                @foreach($conclusions as $conclusion)
                                    @foreach($_GET['conclusion_ids'] as $id)
                                        @if($conclusion->id === intval($id))
                                            <input type="hidden" name="conclusion_ids[]" value="{{$conclusion->id}}"/>
                                        @endif

                                        @if($loop->last && $id === '')
                                            <input type="hidden" name="conclusion_ids[]" value=""/>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endif
                            @if($_GET)
                                <input type="hidden" name="checked" value="{{$_GET['checked']}}"/>
                                <input type="hidden" name="order" value="{{$_GET['order']}}"/>
                                <input type="hidden" name="alphabetical" value="{{$_GET['alphabetical']}}"/>
                            @else
                                <input type="hidden" name="url_type_id" value=""/>
                                <input type="hidden" name="conclusion_ids[]" value=""/>
                                <input type="hidden" name="checked" value=""/>
                                <input type="hidden" name="order" value="desc"/>
                                <input type="hidden" name="alphabetical" value="desc"/>
                            @endif

                            <button class="bg-transparent border-0" style="color: #f96332;" type="submit" title="{{__('title.download_excel_promotion_urls')}}">
                                <i class="fas fa-file-download fa-2x"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="container-fluid">
                @forelse($promotionUrls as $promotionUrl)
                    @if($loop->index % 2 == 0)
                        <div class="row {{$loop->iteration === count($promotionUrls) - 1 ? '' : 'mb-md-2'}}">
                    @endif
                    <div class="col-12 col-md-6 p-0">
                        <div class="bg-white shadow-sm mb-2 mb-xl-0 p-2 {{$loop->index % 2 == 0 ? 'mr-md-2' : ''}}">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div title="{{__('role.customer')}}">{{$promotionUrl->customer_id ? $promotionUrl->customer_name : __('form.no_customer')}}</div>
                                    <div title="{{__('website.url')}}">{{$promotionUrl->url}}</div>
                                </div>
                                <div>
                                    <div title="{{__('role.supplier')}}">{{$promotionUrl->supplier_name}}</div>
                                </div>
                            </div>
                            <div class="my-4" title="{{$promotionUrl->type}}">{{$promotionUrl->type}}: {{$promotionUrl->promotion_url}}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                <x-nav-link class="p-0" :href="route('seo.promotion-urls.check', ['promotion_url' => $promotionUrl->id])" :active="request()->routeIs('seo.promotion-urls.check', ['promotion_url' => $promotionUrl->id])" aria-label="{{__('title.check_promotion_url')}}" title="{{__('title.check_promotion_url')}}">
                                    <i class="fas fa-star fa-2x"></i>
                                </x-nav-link>
                                <div class="d-flex align-items-center" title="{{__('promotionUrl.last_checked')}}">
                                    @if($promotionUrl->conclusion_id === \App\Models\ConclusionType::ACCEPTED)
                                        <i class="far fa-check-circle fa-lg text-success mr-2"></i>
                                        {{__('promotionUrl.last_checked')}}:
                                        {{
                                            date_format(
                                                date_create(\App\Models\PromotionUrlCheck::getCheckedDates($promotionUrl->id)),
                                                'd-m-Y'
                                            )
                                        }}
                                    @elseif($promotionUrl->conclusion_id === \App\Models\ConclusionType::DENIED)
                                        <i class="far fa-times-circle fa-lg text-danger mr-2"></i>
                                        {{__('promotionUrl.last_checked')}}:
                                        {{
                                            date_format(
                                                date_create(\App\Models\PromotionUrlCheck::getCheckedDates($promotionUrl->id)),
                                                'd-m-Y'
                                            )
                                        }}
                                    @elseif($promotionUrl->conclusion_id === \App\Models\ConclusionType::TEMPORARY_DENIED)
                                        <i class="fas fa-spinner fa-lg text-warning mr-2"></i>
                                        {{__('promotionUrl.last_checked')}}:
                                        {{
                                            date_format(
                                                date_create(\App\Models\PromotionUrlCheck::getCheckedDates($promotionUrl->id)),
                                                'd-m-Y'
                                            )
                                        }}
                                    @else
                                        <i class="fas fa-clipboard-list fa-lg text-muted mr-2"></i>
                                        {{__('promotionUrl.not_checked')}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($loop->index % 2 == 1)
                        </div>
                    @endif
                @empty
                    <div class="row bg-white shadow-sm p-2">
                        {{__('pagination.promotion_urls_not_found')}}
                    </div>
                @endforelse
                <div
                    @if(!$promotionUrls->isEmpty()) class="mt-2"> {{$promotionUrls->links()}} @else > @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
