<x-app-layout
    :active-page="'seo_check_promotion_urls'"
    :css="asset('css/seo/promotion-urls/check.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('check.promotion_url_assessment')}}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('promotionUrlCheckError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('promotionUrlCheckError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div class="w-100">
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('role.customer')}}</b>
                                        <div>
                                            @if($company_customer->name !== null)
                                                {{$company_customer->name}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('role.supplier')}}</b>
                                        <div>
                                            @if($company_supplier->name !== null)
                                                {{$company_supplier->name}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('promotionUrl.promotion_url')}}</b>
                                        <div>
                                            @if($promotionUrl->promotion_url !== null)
                                                {{$promotionUrl->promotion_url}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('promotionUrl.type')}}</b>
                                        <div>
                                            @if($promotionUrl->urlType->name !== null)
                                                {{$promotionUrl->urlType->name}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('title.promotion_url_price')}}</b>
                                        <div>
                                            @if(isset($promotionUrl->custom_price))
                                                € {{$promotionUrl->custom_price}}
                                            @elseif($promotionUrlPrice)
                                                € {{$promotionUrlPrice->price}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.domain_authority')}}</b>
                                        <div>
                                            @if($apiData['domain_authority'] !== null)
                                                {{$apiData['domain_authority']}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.trust_flow')}}</b>
                                        <div>
                                            @if($apiData['trust_flow'] !== null)
                                                {{$apiData['trust_flow']}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.citation_flow')}}</b>
                                        <div>
                                            @if($apiData['citation_flow'] !== null)
                                                {{$apiData['citation_flow']}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.domain_name')}}</b>
                                        <div>
                                            @if(str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST)) !== null)
                                                {{str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST))}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.server_ip')}}</b>
                                        <div>
{{--                                            @if($webcrawler['server_ip'] !== null)--}}
{{--                                                {{$webcrawler['server_ip']}}--}}
{{--                                            @else--}}
{{--                                                ---}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.http_status')}}</b>
                                        <div>
{{--                                            @if($webcrawler['http_status'] !== null)--}}
{{--                                                {{$webcrawler['http_status']}}--}}
{{--                                            @else--}}
{{--                                                ---}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.page_language')}}</b>
                                        <div>
{{--                                            @if($webcrawler['page_language'] !== null)--}}
{{--                                                {{$webcrawler['page_language']}}--}}
{{--                                            @else--}}
{{--                                                ---}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.page_title')}}</b>
                                        <div>
{{--                                            @if($webcrawler['page_title'] !== null)--}}
{{--                                                {{$webcrawler['page_title']}}--}}
{{--                                            @else--}}
{{--                                                ---}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.page_description')}}</b>
                                        <div>
{{--                                            @if($webcrawler['page_description'] !== null)--}}
{{--                                                {{$webcrawler['page_description']}}--}}
{{--                                            @else--}}
{{--                                                ---}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.page_keywords')}}</b>
                                        <div>-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.backlinks')}}</b>
                                        <div class="d-flex">
                                            <div>
{{--                                                @if($webcrawler['follow_customer_backlinks'] !== null)--}}
{{--                                                    {{$webcrawler['follow_customer_backlinks']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                            <div>&nbsp; / &nbsp;</div>
                                            <div>
{{--                                                @if($webcrawler['no_follow_customer_backlinks'] !== null)--}}
{{--                                                    {{$webcrawler['no_follow_customer_backlinks']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.external_links')}}</b>
                                        <div class="d-flex">
                                            <div>
{{--                                                @if($webcrawler['follow_external_links'] !== null)--}}
{{--                                                    {{$webcrawler['follow_external_links']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                            <div>&nbsp; / &nbsp;</div>
                                            <div>
{{--                                                @if($webcrawler['no_follow_external_links'] !== null)--}}
{{--                                                    {{$webcrawler['no_follow_external_links']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.social_links')}}</b>
                                        <div class="d-flex">
                                            <div>
{{--                                                @if($webcrawler['follow_social_links'] !== null)--}}
{{--                                                    {{$webcrawler['follow_social_links']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                            <div>&nbsp; / &nbsp;</div>
                                            <div>
{{--                                                @if($webcrawler['no_follow_socials'] !== null)--}}
{{--                                                    {{$webcrawler['no_follow_socials']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.internal_links')}}</b>
                                        <div class="d-flex">
                                            <div>
{{--                                                @if($webcrawler['follow_internal_links'] !== null)--}}
{{--                                                    {{$webcrawler['follow_internal_links']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                            <div>&nbsp; / &nbsp;</div>
                                            <div>
{{--                                                @if($webcrawler['no_follow_internal_links'] !== null)--}}
{{--                                                    {{$webcrawler['no_follow_internal_links']}}--}}
{{--                                                @else--}}
{{--                                                    ---}}
{{--                                                @endif--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.found_backlinks')}}</b>
                                        <div>-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.found_customers')}}</b>
                                        <div>-</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.latest_scan')}}</b>
                                        <div>
                                            @if($check->latest_scan !== null)
                                                {{date_format(date_create($check->latest_scan), 'd-m-Y h:m')}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.latest_update')}}</b>
                                        <div>
                                            @if($check->latest_scan_update !== null)
                                                {{date_format(date_create($check->latest_scan_update), 'd-m-Y h:m')}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <form method="GET" action="{{ route('seo.promotion-urls.checking', ['promotion_url' => $promotionUrl->id]) }}">
                                        <button class="btn btn-primary" type="submit">{{__('check.scan_url')}}</button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                            <h3 class="mb-0">{{ __('check.previous_evaluation') }}</h3>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.checked_at')}}</b>
                                        <div>
                                            @if($check->measured_at !== null)
                                                {{date_format(date_create($check->measured_at), 'd-m-Y h:m')}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.checked_by')}}</b>
                                        <div>
                                            @if(isset($check->user_id))
                                                {{$check->firstname . ' ' . $check->inserts . ' ' . $check->lastname}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.observations')}}</b>
                                        @if($observationChecks[0]['id'] === '-')
                                            <br>-
                                        @else
                                            <ul>
                                                @foreach($observationChecks as $observation)
                                                    <li>{{$observation['name_' . auth()->user()->language->code] ? $observation['name_' . auth()->user()->language->code] : $observation['name_en']}}</li>
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
                                        <div>
                                            @if(isset($check->commentary))
                                                {{$check->commentary}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.status')}}</b>
                                        <div>{{__('conclusion_types.' . $conclusion)}}</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.basic_assessment')}}</b>
                                        <div>
                                            @if($promotionUrl->conclusion_id === \App\Models\ConclusionType::ACCEPTED)
                                                <i class="far fa-check-circle fa-lg text-success mr-2"></i>
                                            @elseif($promotionUrl->conclusion_id === \App\Models\ConclusionType::DENIED)
                                                <i class="far fa-times-circle fa-lg text-danger mr-2"></i>
                                            @elseif($promotionUrl->conclusion_id === \App\Models\ConclusionType::TEMPORARY_DENIED)
                                                <i class="fas fa-spinner fa-lg text-warning mr-2"></i>
                                            @else
                                                <i class="fas fa-clipboard-list fa-lg text-muted mr-2"></i>
                                            @endif
                                            Valid URL
                                        </div>
                                        <div>- Server/IP is unique.</div>
                                        <div>- Found language: nl</div>
                                        <div>- Found title: 4 words</div>
                                        <div>- No description found.</div>
                                        <div>- No keywords found.</div>
                                        <div>- Found 1 backlinks.</div>
                                        <div>- Found 477 external links; 1 are nofollow-links.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <b>{{__('check.expected_result')}}</b>
                                        <div>-</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <form method="POST" action="{{ route('seo.promotion-urls.assessment', ['promotion_url' => $promotionUrl->id]) }}">
                                @csrf
                                <input type="hidden" name="moz_indexed_at" value="{{$apiData['moz_indexed_at']}}"/>
                                <input type="hidden" name="domain_authority" value="{{$apiData['domain_authority']}}"/>
                                <input type="hidden" name="majestic_indexed_at" value="{{$apiData['majestic_indexed_at']}}"/>
                                <input type="hidden" name="trust_flow" value="{{$apiData['trust_flow']}}"/>
                                <input type="hidden" name="citation_flow" value="{{$apiData['citation_flow']}}"/>
                                <input type="hidden" name="domain_name" value="{{str_replace("www.","", parse_url($promotionUrl->promotion_url, PHP_URL_HOST))}}"/>
{{--                                <input type="hidden" name="server_ip" value="{{$webcrawler['server_ip']}}"/>--}}
{{--                                <input type="hidden" name="http_status" value="{{$webcrawler['http_status']}}"/>--}}
{{--                                <input type="hidden" name="page_language" value="{{$webcrawler['page_language']}}"/>--}}
{{--                                <input type="hidden" name="page_title" value="{{$webcrawler['page_title']}}"/>--}}
{{--                                <input type="hidden" name="page_description" value="{{$webcrawler['page_description']}}"/>--}}
{{--                                <input type="hidden" name="measured_at" value="{{date_format(date_create($check['measured_at']), 'Y-m-d H:i:s')}}"/>--}}
{{--                                <input type="hidden" name="latest_scan" value="{{date_format(date_create($check->latest_scan), 'Y-m-d H:i:s')}}"/>--}}
{{--                                <input type="hidden" name="latest_scan_update" value="{{date_format(date_create($check->latest_scan_update), 'Y-m-d H:i:s')}}"/>--}}
{{--                                <input type="hidden" name="follow_backlinks" value="{{$webcrawler['follow_customer_backlinks']}}"/>--}}
{{--                                <input type="hidden" name="no_follow_backlinks" value="{{$webcrawler['no_follow_customer_backlinks']}}"/>--}}
{{--                                <input type="hidden" name="follow_external_links" value="{{$webcrawler['follow_external_links']}}"/>--}}
{{--                                <input type="hidden" name="no_follow_external_links" value="{{$webcrawler['no_follow_external_links']}}"/>--}}
{{--                                <input type="hidden" name="follow_social_links" value="{{$webcrawler['follow_social_links']}}"/>--}}
{{--                                <input type="hidden" name="no_follow_socials" value="{{$webcrawler['no_follow_socials']}}"/>--}}
{{--                                <input type="hidden" name="follow_internal_links" value="{{$webcrawler['follow_internal_links']}}"/>--}}
{{--                                <input type="hidden" name="no_follow_internal_links" value="{{$webcrawler['no_follow_internal_links']}}"/>--}}
{{--                                <input type="hidden" name="image_count" value="{{$webcrawler['image_count']}}"/>--}}

                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <b>{{__('check.observations')}}</b>
                                            @foreach($observations as $observation)
                                                <div class="form-check d-flex">
                                                    <input id="observationCheckboxes{{$loop->index}}" name="observationCheckboxes[]" class="form-check-input" type="checkbox" value="{{$observation['id']}}"
                                                       @foreach($observationChecks as $observationCheck)
                                                           @if($observation->id === $observationCheck['id']) checked @endif
                                                       @endforeach
                                                    >
                                                    <span class="form-check-sign">
                                                        <span class="check"></span>
                                                    </span>
                                                    <label for="observationCheckboxes{{$loop->index}}" style="padding-left: 10px;" class="form-check-label @if($loop->last) mb-0 @else mb-2 @endif">{{$observation['name_' . auth()->user()->language->code] ? $observation['name_' . auth()->user()->language->code] : $observation['name_en']}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <label for="commentary" style="font-size: inherit; margin: 0; color: inherit;"><b>{{__('check.commentary')}}</b></label>
                                            <textarea id="commentary" name="commentary" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        <div class="form-group">
                                            <b>{{__('check.conclusion')}}</b>
                                            @foreach($conclusionTypes as $conclusionType)
                                                @if($loop->index !== 0)
                                                    <div class="form-check form-check-radio d-flex">
                                                        <input class="my-2 form-check-input" type="radio" name="conclusionRadios" id="conclusionRadios{{$loop->index}}" value="{{$conclusionType->id}}" required
                                                               @if($promotionUrl->conclusion_id === $conclusionType->id) checked @endif
                                                        >
                                                        <span class="form-check-sign"></span>
                                                        <label for="conclusionRadios{{$loop->index}}" style="padding-left: 10px;" class="form-check-label @if($loop->last) mb-0 @else mb-2 @endif">{{__('conclusion_types.' . $conclusionType->name)}}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 pr-1">
                                        @if(isset($newPromotionUrl))
                                            <button class="btn btn-primary" name="submit" value="next" type="submit">{{__('form.submit_and_next')}}</button>
                                        @endif
                                        <button class="btn {{isset($newPromotionUrl) ? 'btn-secondary' : 'btn-primary'}}" name="submit" value="done" type="submit">{{__('form.submit')}}</button>
                                        <a href="{{route('seo.promotion-urls.index')}}" class="btn btn-secondary" type="submit">{{__('form.cancel')}}</a>
                                    </div>
                                </div>

                                <h3 class="mb-0">{{ __('check.preview') }}</h3>
                                <iframe id="iframe" src="{{$promotionUrl->promotion_url}}" title="Website preview" allow="fullscreen" loading="lazy" style="width: 100%; height: 600px;"></iframe>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
