<x-app-layout
    :active-page="'seo_index_price_type'"
    :css="asset('css/seo/price-type/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.promotion_url_prices') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storePriceType'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storePriceType'] }}
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link :href="route('seo.price-types.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('seo.price-types.create')" aria-label="{{__('title.add_promotion_url_price')}}" title="{{__('title.add_promotion_url_price')}}">
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
                        @forelse($priceTypes as $priceType)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="w-25 mr-2" title="{{__('priceType.name.name')}}">{{$priceType['name_' . auth()->user()->language->code] ? $priceType['name_' . auth()->user()->language->code] : $priceType['name_en']}}</div>
                                    <div class="w-100 mr-2" title="{{__('title.promotion_url_price')}}">€ {{$priceType->price}}</div>
                                    <x-nav-link class="mr-2 p-0" :href="route('seo.price-types.edit', ['price_type' => $priceType->id])" :active="request()->routeIs('seo.price-types.edit', ['price_type' => $priceType->id])" aria-label="{{__('title.edit_promotion_url_price')}}" title="{{__('title.edit_promotion_url_price')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                    @if(\App\Models\PromotionUrl::where('price_type_id', '=', $priceType->id)->exists())
                                        <form method="POST" action="{{ route('seo.price-types.archive', ['price_type' => $priceType->id]) }}">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.archive_promotion_url_price')}}">
                                                <i class="fas fa-archive fa-2x"></i>
                                            </a>
                                        </form>
                                    @else
                                        <a class="d-flex justify-content-center" style="width: 30px" href="#" title="{{__('title.delete_promotion_url_price')}}">
                                            <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$priceType->id}}"></i>
                                        </a>
                                        <x-modal
                                            :id="$priceType->id"
                                            :title="$priceType['name_' . auth()->user()->language->code]"
                                            :description="__('modal.delete_message', ['item' => $priceType['name_' . auth()->user()->language->code]])"
                                            :route="route('seo.price-types.destroy', $priceType->id)"
                                            :method="'DELETE'"
                                        ></x-modal>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.promotion_url_price_types_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$priceTypes->isEmpty()) class="mt-2"> {{$priceTypes->links()}} @else > @endif
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
                    @foreach($priceTypes as $index => $priceType)
                        const ps_{{$index}} = new PerfectScrollbar('#modal-{{$priceType->id}}');
                        ps_{{$index}}.destroy();
                    @endforeach
                });
            }
        });
    </script>
</x-app-layout>
