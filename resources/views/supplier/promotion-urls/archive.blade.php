<x-app-layout
    :active-page="'supplier_archive_promotion_urls'"
    :css="asset('css/supplier/promotion-urls/archive.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('promotionUrl.archived')}}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('promotionUrlError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('promotionUrlError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                            <form class="w-100" method="POST" action="{{ route('supplier.promotion-urls.recover', ['promotion_url' => $promotionUrl->id]) }}">
                                                @csrf
                                                <a class="p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.recover_promotion_url')}}">
                                                    <i class="fas fa-undo-alt fa-2x"></i>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="my-4" title="{{__('url_types.' . $promotionUrl->type)}}">{{$promotionUrl->type}}: {{$promotionUrl->promotion_url}}</div>
                                    <div class="d-flex justify-content-end align-items-center">
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
