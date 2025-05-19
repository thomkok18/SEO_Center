<x-app-layout
    :active-page="'supplier_show_promotion_urls'"
    :css="asset('css/supplier/promotion-urls/show.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{$promotionUrl->promotion_url}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updatePromotionUrl'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updatePromotionUrl'] }}
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
                        <div class="d-md-flex align-items-center">
                            <form class="w-100" method="POST" action="{{ route('supplier.promotion-urls.update', ['promotion_url' => $promotionUrl->id]) }}">
                                @method('PATCH')
                                @csrf
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <x-label for="website_id">{{trans_choice('promotionUrl.customer_website', 1)}}</x-label>
                                            <select id="website_id" class="form-control" name="website_id" :value="old('website_id')" autofocus>
                                                <option value="" selected>{{__('form.no_customer_website')}}</option>
                                                @foreach($websites as $website)
                                                    <option value="{{$website->id}}" @if($website->id === $promotionUrl->website_id) selected @endif>{{$website->url}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <x-label for="promotion_url">{{__('promotionUrl.promotion_url')}}</x-label>
                                            <x-input id="promotion_url" type="text" name="promotion_url" value="{{$promotionUrl->promotion_url}}" required autofocus/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <x-label for="url_type_id">{{__('promotionUrl.type')}}</x-label>
                                            <select id="url_type_id" class="form-control" name="url_type_id" required autofocus>
                                                @foreach($urlTypes as $urlType)
                                                    <option value="{{$urlType->id}}" @if($urlType->id === $promotionUrl->url_type_id) selected @endif>{{$urlType->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <x-label for="price">{{__('promotionUrl.price')}}</x-label>
                                            <x-input id="price" type="number" min="0" step="0.01" name="price" placeholder="0.00" value="{{$promotionUrl->custom_price}}" required autofocus />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="d-flex flex-column">
                                            <x-label for="archived">{{__('promotionUrl.archived')}}</x-label>
                                            <input type="hidden" name="archived" value="0">
                                            <input id="archived" class="bootstrap-switch" type="checkbox" name="archived" value="1" @if($promotionUrl->archived) checked @endif data-on-label="<i class='now-ui-icons ui-1_check'></i>" data-off-label="<i class='now-ui-icons ui-1_simple-remove'></i>" autofocus />
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.promotion_url') }}</h3>
                </div>

                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div class="w-100"></div>
                        <a href="mailto:{{$seo_employee->email}}?SUBJECT={{__('mail.mail_to_seo', ['promotion_url' => $promotionUrl->promotion_url, 'customer' => $customer->name, 'date' => date_format(date_create($check->measured_at), 'd-m-Y')])}}" aria-label="{{__('title.mailto_seo')}}" title="{{__('title.mailto_seo')}}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <b>{{__('check.observations')}}</b>
                                @if($observationChecks[0]['id'] === '-')
                                    <br>-
                                @else
                                    <ul>
                                        @foreach($observations as $observation)
                                            @foreach($observationChecks as $observationCheck)
                                                @if($observation->id === $observationCheck['id'])
                                                    <li>{{$observation['name_' . auth()->user()->language->code] ? $observation['name_' . auth()->user()->language->code] : $observation['name_en']}}</li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <b>{{__('check.commentary')}}</b>
                                @if(isset($check->commentary))
                                    <div>{{$check->commentary}}</div>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <b>{{__('check.checked_at')}}</b>
                                <div>
                                    {{date_format(date_create($check->measured_at), 'd-m-Y')}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 pr-1">
                            <div class="form-group">
                                <b>{{__('check.conclusion')}}</b>
                                @foreach($conclusionTypes as $conclusionType)
                                    @if($promotionUrl->conclusion_id === $conclusionType->id)
                                        <div>{{__('conclusion_types.' . $conclusionType->name)}}</div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('supplier.promotion-urls.resubmit', ['promotion_url' => $promotionUrl->id]) }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <button class="btn btn-primary" type="submit">{{__('form.resubmit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
