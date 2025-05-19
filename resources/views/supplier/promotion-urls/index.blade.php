<x-app-layout
    :active-page="'supplier_index_promotion_urls'"
    :css="asset('css/supplier/promotion-urls/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.promotion_url') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storePromotionUrls'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storePromotionUrls'] }}
                        </div>
                    @endif
                    @if (session('status')['destroyPromotionUrls'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['destroyPromotionUrls'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('promotionUrlError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('promotionUrlError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('warning')['promotionUrl'] ?? null)
                        <div class="alert alert-warning" role="alert">
                            {{ session('warning')['promotionUrl'] }}
                        </div>
                    @endif
                    <div class="d-lg-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link :href="route('supplier.promotion-urls.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('promotion-url.create')" aria-label="{{__('title.add_promotion_url')}}" title="{{__('title.add_promotion_url')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                            <x-nav-link :href="route('supplier.promotion-urls.import')" class="p-0 py-2 pr-3" :active="request()->routeIs('supplier.promotion-urls.import')" aria-label="{{__('title.import_promotion_url')}}" title="{{__('title.import_promotion_url')}}">
                                <i class="fas fa-file-import fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('supplier.promotion-urls.search') }}">
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
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div title="{{__('role.customer')}}">{{$promotionUrl->customer_id ? $promotionUrl->customer_name : __('form.no_customer')}}</div>
                                    <div title="{{__('website.url')}}">{{$promotionUrl->url}}</div>
                                </div>
                                <div>
                                    @if(\App\Models\PromotionUrlCheck::where('promotion_url_id', '=', $promotionUrl->id)->exists())
                                        <form class="w-100" method="POST" action="{{ route('supplier.promotion-urls.archive', ['promotion_url' => $promotionUrl->id]) }}">
                                            @csrf
                                            <a aria-label="Archive promotion url" class="p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.archive_promotion_url')}}">
                                                <i class="fas fa-archive fa-2x"></i>
                                            </a>
                                        </form>
                                    @else
                                        <a aria-label="{{__('title.delete_promotion_url')}}" href="#" title="{{__('title.delete_promotion_url')}}">
                                            <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$promotionUrl->id}}"></i>
                                        </a>
                                        <x-modal
                                            :id="$promotionUrl->id"
                                            :title="$promotionUrl->promotion_url"
                                            :description="__('modal.delete_message', ['item' => $promotionUrl->promotion_url])"
                                            :route="route('supplier.promotion-urls.destroy', $promotionUrl->id)"
                                            :method="'DELETE'"
                                        ></x-modal>
                                    @endif
                                </div>
                            </div>
                            <div class="my-4" title="{{$promotionUrl->type}}">{{$promotionUrl->type}}: {{$promotionUrl->promotion_url}}</div>
                            <div class="d-flex justify-content-between align-items-center">
                                @if(\App\Models\PromotionUrlCheck::where('promotion_url_id', '=', $promotionUrl->id)->exists() && $promotionUrl->conclusion_id !== \App\Models\ConclusionType::PENDING)
                                    <x-nav-link class="p-0" :href="route('supplier.promotion-urls.show', ['promotion_url' => $promotionUrl->id])" :active="request()->routeIs('supplier.promotion-urls.show', ['promotion_url' => $promotionUrl->id])" aria-label="{{__('title.show_promotion_url')}}" title="{{__('title.show_promotion_url')}}">
                                        <i class="fas fa-info-circle fa-2x"></i>
                                    </x-nav-link>
                                @else
                                    <x-nav-link class="p-0" :href="route('supplier.promotion-urls.edit', ['promotion_url' => $promotionUrl->id])" :active="request()->routeIs('supplier.promotion-urls.edit', ['promotion_url' => $promotionUrl->id])" aria-label="{{__('title.edit_promotion_url')}}" title="{{__('title.edit_promotion_url')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                @endif
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
    <script type="text/javascript">
        // Opening and closing a modal.
        (function () {
            if (navigator.platform.startsWith('Win')) {
                $('.modal').on('show.bs.modal', () => {}).on('hide.bs.modal', () => {
                    @foreach($promotionUrls as $index => $promotionUrl)
                        const ps_{{$index}} = new PerfectScrollbar('#modal-{{$promotionUrl->id}}');
                        ps_{{$index}}.destroy();
                    @endforeach
                });
            }
        });
    </script>
</x-app-layout>
