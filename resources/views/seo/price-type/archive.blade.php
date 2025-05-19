<x-app-layout
    :active-page="'seo_archive_price_type'"
    :css="asset('css/seo/price-type/archive.min.css')"
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
                        @forelse($priceTypes as $priceType)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center">
                                    <div class="w-25" title="{{__('priceType.name')}}">{{$priceType['name_' . auth()->user()->language->code] ? $priceType['name_' . auth()->user()->language->code] : $priceType['name_en']}}</div>
                                    <div class="w-100" title="{{__('title.promotion_url_price')}}">€ {{$priceType->price}}</div>
                                    <form class="ml-2 p-0" method="POST" action="{{ route('seo.price-types.recover', ['price_type' => $priceType->id]) }}">
                                        @csrf
                                        <a class="p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.recover_promotion_url_price')}}">
                                            <i class="fas fa-undo-alt fa-2x"></i>
                                        </a>
                                    </form>
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
</x-app-layout>
