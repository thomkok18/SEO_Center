<x-app-layout
    :active-page="'customer_show_competitor'"
    :css="asset('css/customer/competitors/show.min.css')"
    :font-awesome="true"
>
    <script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-0">{{$competitor->url}}</h3>
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
                        @for($i = 0; $i < 3; $i++)
                            <div class="mb-4">
                                <canvas id="competitorHistoryChart-{{$i}}"></canvas>
                                <script>
                                    var ctx_{{$i}} = document.getElementById('competitorHistoryChart-{{$i}}');
                                    new Chart(ctx_{{$i}}, {
                                        type: 'line',
                                        data: {
                                            labels: [
                                                @foreach($dates as $date)
                                                    '{{
                                                    __('date.' . strtolower(date_format(date_create($date), 'F')))
                                                    . ' - ' .
                                                    date_format(date_create($date), 'Y')
                                                }}',
                                                @endforeach
                                            ],
                                            datasets: [
                                                @if($i === 0)
                                                    {
                                                        label: '{{$competitor->url}}',
                                                        data: [
                                                            @foreach($competitorChecks as $check)
                                                                @if(isset($check->domain_authority))
                                                                    {{$check->domain_authority}},
                                                                @endif
                                                            @endforeach
                                                        ],
                                                        @foreach($competitorChecks as $check)
                                                            @if(isset($check->domain_authority))
                                                                @if($check->domain_authority < 15)
                                                                    borderColor: '#FF4E42',
                                                                @elseif($check->domain_authority < 25)
                                                                    borderColor: '#FFA400',
                                                                @elseif($check->domain_authority < 45)
                                                                    borderColor: '#0CCE6B',
                                                                @else
                                                                    borderColor: '#078240',
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        fill: false
                                                    },
                                                    @foreach($customerWebsiteChecks as $website => $customerWebsiteCheck)
                                                        {
                                                            label: '{{$website}}',
                                                            data: [
                                                                @foreach($customerWebsiteCheck as $check)
                                                                    @if(isset($check->domain_authority))
                                                                        {{$check->domain_authority}},
                                                                    @endif
                                                                @endforeach
                                                            ],
                                                            @foreach($customerWebsiteCheck as $check)
                                                                @if(isset($check->domain_authority))
                                                                    @if($check->domain_authority < 15)
                                                                        borderColor: '#FF4E42',
                                                                    @elseif($check->domain_authority < 25)
                                                                        borderColor: '#FFA400',
                                                                    @elseif($check->domain_authority < 45)
                                                                        borderColor: '#0CCE6B',
                                                                    @else
                                                                        borderColor: '#078240',
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            fill: false
                                                        },
                                                    @endforeach
                                                @endif
                                                @if($i === 1)
                                                    {
                                                        label: '{{$competitor->url}}',
                                                        data: [
                                                            @foreach($competitorChecks as $check)
                                                                @if(isset($check->trust_flow) && isset($check->citation_flow))
                                                                    {{$check->trust_flow / $check->citation_flow * 100}},
                                                                @endif
                                                            @endforeach
                                                        ],
                                                        @foreach($competitorChecks as $check)
                                                            @if(isset($check->domain_authority))
                                                                @if($check->trust_flow / $check->citation_flow * 100 < 50)
                                                                    borderColor: '#FF4E42',
                                                                @elseif($check->trust_flow / $check->citation_flow * 100 < 100)
                                                                    borderColor: '#FFA400',
                                                                @elseif($check->trust_flow / $check->citation_flow * 100 < 125)
                                                                    borderColor: '#0CCE6B',
                                                                @else
                                                                    borderColor: '#078240',
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        fill: false
                                                    },
                                                    @foreach($customerWebsiteChecks as $website => $customerWebsiteCheck)
                                                        {
                                                            label: '{{$website}}',
                                                            data: [
                                                                @foreach($customerWebsiteCheck as $check)
                                                                    @if(isset($check->trust_flow) && isset($check->citation_flow))
                                                                        {{$check->trust_flow / $check->citation_flow * 100}},
                                                                    @endif
                                                                @endforeach
                                                            ],
                                                            @foreach($customerWebsiteCheck as $check)
                                                                @if(isset($check->trust_flow) && isset($check->citation_flow))
                                                                    @if($check->trust_flow / $check->citation_flow * 100 < 50)
                                                                        borderColor: '#FF4E42',
                                                                    @elseif($check->trust_flow / $check->citation_flow * 100 < 100)
                                                                        borderColor: '#FFA400',
                                                                    @elseif($check->trust_flow / $check->citation_flow * 100 < 125)
                                                                        borderColor: '#0CCE6B',
                                                                    @else
                                                                        borderColor: '#078240',
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                            fill: false
                                                        },
                                                    @endforeach
                                                @endif
                                                @if($i === 2)
                                                    {
                                                        label: '{{$competitor->url}}',
                                                        data: [
                                                            @foreach($competitorChecks as $check)
                                                                @if(isset($check->domain_authority) && isset($check->trust_flow) && isset($check->citation_flow))
                                                                    200 - (
                                                                    {{$check->domain_authority}} +
                                                                    {{$check->trust_flow / $check->citation_flow * 100}}
                                                                    ),
                                                                @endif
                                                            @endforeach
                                                        ],
                                                        borderColor: '#808080',
                                                        fill: false
                                                    },
                                                    @foreach($customerWebsiteChecks as $website => $customerWebsiteCheck)
                                                        {
                                                            label: '{{$website}}',
                                                            data: [
                                                                @foreach($customerWebsiteCheck as $check)
                                                                    @if(isset($check->domain_authority) && isset($check->trust_flow) && isset($check->citation_flow))
                                                                    200 - (
                                                                    {{$check->domain_authority}} +
                                                                    {{$check->trust_flow / $check->citation_flow * 100}}
                                                                    ),
                                                                    @endif
                                                                @endforeach
                                                            ],
                                                            borderColor: '#808080',
                                                            fill: false
                                                        },
                                                    @endforeach
                                                @endif
                                            ]
                                        },
                                        options: {
                                            plugins: {
                                                title: {
                                                    display: true,
                                                    @switch($i)
                                                        @case(0)
                                                            text: '{{__('check.domain_authority')}}'
                                                        @break

                                                        @case(1)
                                                            text: '{{__('check.trust_ratio')}}'
                                                        @break

                                                        @case(2)
                                                            text: '{{__('check.unused_score')}}'
                                                        @break

                                                        @default
                                                            text: '{{__('check.status')}}'
                                                    @endswitch
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
