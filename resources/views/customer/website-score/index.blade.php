<x-app-layout
    :active-page="'customer_index_website_score'"
    :css="asset('css/customer/website-score/index.min.css')"
    :font-awesome="true"
>
    <script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $website->url }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 p-0">
                        <div>
                            <canvas id="websiteScoreHistoryChart"></canvas>
                            <script>
                                var ctx = document.getElementById('websiteScoreHistoryChart');
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: [
                                            @foreach($checks as $check)
                                            '{{
                                                __('date.' . strtolower(date_format(date_create($check->datetime), 'F')))
                                                . ' - ' .
                                                date_format(date_create($check->datetime), 'Y')
                                            }}',
                                            @endforeach
                                        ],
                                        datasets: [
                                            {
                                                label: '{{__('check.domain_authority')}}',
                                                data: [
                                                    @foreach($checks as $check)
                                                        {{$check->domain_authority}},
                                                    @endforeach
                                                ],
                                                @if($check->domain_authority < 15)
                                                    borderColor: '#FF4E42',
                                                @elseif($check->domain_authority < 25)
                                                    borderColor: '#FFA400',
                                                @elseif($check->domain_authority < 45)
                                                    borderColor: '#0CCE6B',
                                                @else
                                                    borderColor: '#078240',
                                                @endif
                                                fill: false
                                            },
                                            {
                                                label: '{{__('check.trust_ratio')}}',
                                                data: [
                                                    @foreach($checks as $check)
                                                        {{$check->trust_flow / $check->citation_flow * 100}},
                                                    @endforeach
                                                ],
                                                @if($check->trust_flow / $check->citation_flow * 100 < 50)
                                                    borderColor: '#FF4E42',
                                                @elseif($check->trust_flow / $check->citation_flow * 100 < 100)
                                                    borderColor: '#FFA400',
                                                @elseif($check->trust_flow / $check->citation_flow * 100 < 125)
                                                    borderColor: '#0CCE6B',
                                                @else
                                                    borderColor: '#078240',
                                                @endif
                                                fill: false
                                            },
                                            {
                                                label: '{{__('check.unused_score')}}',
                                                data: [
                                                    @foreach($checks as $check)
                                                        200 - (
                                                            {{$check->domain_authority}} +
                                                            {{$check->trust_flow / $check->citation_flow * 100}}
                                                        ),
                                                    @endforeach
                                                ],
                                                borderColor: '#808080',
                                                fill: false
                                            },
                                        ]
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
