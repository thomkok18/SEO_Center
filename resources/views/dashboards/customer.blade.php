<x-app-layout
    :active-page="'dashboard_customer'"
    :css="asset('css/dashboards/customer.min.css')"
    :font-awesome="true"
>
    <script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.Dashboard') }}</h3>
                </div>

                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="GET" action="{{ route('customer.websites.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_website')}}" autofocus/>
                                </div>
                                <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                            </div>
                        </form>
                        <a href="mailto:@foreach($seoEmployees as $seoEmployee){{$seoEmployee->email}};@endforeach" aria-label="{{__('title.mailto')}}" title="{{__('title.mailto')}}" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-envelope fa-2x"></i>
                        </a>
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
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div title="{{__('website.url')}}">{{$website->url}}</div>
                                        <div title="{{__('website.monthly_budget')}}">€ {{$website->amount}}</div>
                                    </div>
                                    <div>
                                        <a class="mr-2" href="{{route('customer.website-score', $website->id)}}" aria-label="{{__('title.website_score_history')}}" title="{{__('title.website_score_history')}}">
                                            <i class="fas fa-book fa-2x"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex flex-column-reverse flex-md-row justify-content-between mt-2">
                                    <div class="d-flex align-items-end">
                                        <a class="mr-2" href="{{route('customer.promotion-urls', $website->id)}}" title="{{__('title.see_blogs_and_backlinks')}}">
                                            <i class="fas fa-info-circle fa-2x"></i>
                                        </a>
                                        <div class="d-flex flex-column">
                                            <div>
                                                {{trans_choice('url_types.blog', $website->blog_amount, ['value' => $website->blog_amount])}}
                                            </div>
                                            <div>
                                                {{trans_choice('url_types.backlink', $website->backlink_amount, ['value' => $website->backlink_amount])}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div style="max-width: 200px;">
                                            <canvas id="websiteScoreChart{{$loop->index}}"></canvas>
                                            <script>
                                                var ctx = document.getElementById('websiteScoreChart{{$loop->index}}');
                                                var myChart = new Chart(ctx, {
                                                    type: 'pie',
                                                    data: {
                                                        labels: [
                                                            '{{__('check.domain_authority')}}',
                                                            '{{__('check.trust_ratio')}}',
                                                            '{{__('check.unused_score')}}',
                                                        ],
                                                        datasets: [{
                                                            label: 'Website score',
                                                            data: [
                                                                {{$website->domain_authority}},
                                                                {{$website->trust_flow / $website->citation_flow * 100}},
                                                                200 - (
                                                                    {{$website->domain_authority}} +
                                                                    {{$website->trust_flow / $website->citation_flow * 100}}
                                                                )
                                                            ],
                                                            backgroundColor: [
                                                                @if($website->domain_authority < 15)
                                                                    '#FF4E42',
                                                                @elseif($website->domain_authority < 25)
                                                                    '#FFA400',
                                                                @elseif($website->domain_authority < 45)
                                                                    '#0CCE6B',
                                                                @else
                                                                    '#078240',
                                                                @endif

                                                                @if($website->trust_flow / $website->citation_flow * 100 < 50)
                                                                    '#FF4E42',
                                                                @elseif($website->trust_flow / $website->citation_flow * 100 < 100)
                                                                    '#FFA400',
                                                                @elseif($website->trust_flow / $website->citation_flow * 100 <= 125)
                                                                    '#0CCE6B',
                                                                @else
                                                                    '#078240',
                                                                @endif

                                                                '{{'#808080'}}',
                                                            ],
                                                            hoverOffset: 4
                                                        }]
                                                    }
                                                });
                                            </script>
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
</x-app-layout>
