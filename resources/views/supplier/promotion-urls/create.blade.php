<x-app-layout
    :active-page="'supplier_create_promotion_urls'"
    :css="asset('css/supplier/promotion-urls/create.min.css')"
    :font-awesome="true"
>
    <script>
        function enablePriceType() {
            const price_type_container = document.getElementById('price_type_container');
            const custom_price_container = document.getElementById('custom_price_container');

            price_type_container.classList.remove('d-none');
            custom_price_container.classList.add('d-none');

            document.getElementById('custom_price').value = '';
        }

        function enableCustomPrice() {
            const price_type_container = document.getElementById('price_type_container');
            const custom_price_container = document.getElementById('custom_price_container');

            custom_price_container.classList.remove('d-none');
            price_type_container.classList.add('d-none');

            for (let i = 0; i < {{count($priceTypes)}}; i++) {
                if (document.getElementById('price_type_' + i)) {
                    document.getElementById('price_type_' + i).checked = false;
                }
            }
        }
    </script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('promotionUrl.search_customer_website')}}</h3>
                </div>

                <div class="card-body">
                    <form class="w-100" method="GET" action="{{ route('supplier.promotion-urls.create-search') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <x-label for="customer_id">{{__('role.customer')}}</x-label>
                                    <select id="customer_id" class="form-control" name="customer_id" :value="old('customer_id')" required autofocus>
                                        <option value="" selected>{{__('form.no_customer')}}</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}" @if($customer->id === intval(request('customer_id'))) selected @endif>{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.create_promotion_url')}}</h3>
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
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('supplier.promotion-urls.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="website_id">{{trans_choice('promotionUrl.customer_website', 1)}}</x-label>
                                        <select id="website_id" class="form-control" name="website_id" :value="old('website_id')" autofocus>
                                            <option value="" selected>{{__('form.no_customer_website')}}</option>
                                            @foreach($websites as $website)
                                                <option value="{{$website->id}}">{{$website->url}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="promotion_url">{{__('promotionUrl.promotion_url')}}</x-label>
                                        <x-input id="promotion_url" type="text" name="promotion_url" :value="old('promotion_url')" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="url_type_id">{{__('promotionUrl.type')}}</x-label>
                                        <select id="url_type_id" class="form-control" name="url_type_id" required autofocus>
                                            @foreach($urlTypes as $urlType)
                                                <option value="{{$urlType->id}}">{{$urlType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="choose_price_type">{{__('title.promotion_url_price')}}</x-label>
                                        <div id="choose_price_type">
                                            <div class="d-flex align-items-center mb-2">
                                                <input id="choose_price" class="my-2 mr-1" type="radio" name="choose_price" onclick="enablePriceType()" required autofocus checked />
                                                <label for="choose_price" class="mb-0">{{__('priceType.choose_price')}}</label>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <input id="choose_custom_price" class="my-2 mr-1" type="radio" name="choose_price" onclick="enableCustomPrice()" required autofocus />
                                                <label for="choose_custom_price" class="mb-0">{{__('priceType.custom_price')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <div id="price_type_container" class="">
                                            <x-label for="choose_price_type">{{__('promotionUrl.price')}}</x-label>
                                            @foreach($priceTypes as $priceType)
                                                <div>
                                                    <input id="price_type_{{$priceType->id}}" class="my-2 mr-1" type="radio" name="price_type_id" value="{{$priceType->id}}" autofocus />
                                                    <label for="price_type_{{$priceType->id}}" class="mb-0">{{$priceType['name_' . auth()->user()->language->code] ? $priceType['name_' . auth()->user()->language->code] . ' - ' . $priceType->price : $priceType['name_en'] . ' - ' . $priceType->price}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div id="custom_price_container" class="d-none">
                                            <x-label for="custom_price">{{__('promotionUrl.price')}}</x-label>
                                            <x-input id="custom_price" type="number" min="0" step="0.01" name="custom_price" placeholder="0.00" :value="old('custom_price')" autofocus />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
