<x-app-layout
    :active-page="'supplier_index_website_budget'"
    :css="asset('css/supplier/website-budget/index.min.css')"
    :font-awesome="true"
>
    <script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.website_budget') }}</h3>
                    <h4 class="m-0" title="{{__('title.customer_budget_left')}}">&euro; {{$websiteBudgetLeft}}</h4>
                </div>

                <div class="card-body">
                    <canvas id="websiteBudgetChart"></canvas>
                    <script>
                        var ctx = document.getElementById('websiteBudgetChart').getContext("2d");

                        const dates = [
                            @foreach($budgets as $budget)
                                '{{$budget->date}}',
                            @endforeach
                        ];

                        const futureLineColor = (ctx) => new Date(dates[ctx.p0.parsed.x + 1]) > new Date() ? '#808080' : '#F96332';
                        const futureLineDashStyle = (ctx, value) => new Date(dates[ctx.p0.parsed.x + 1]) > new Date() ? value : undefined;

                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: [
                                    @foreach($dates as $date)
                                        '{{$date}}',
                                    @endforeach
                                ],
                                datasets: [
                                    {
                                        label: "{{__('website.budget')}}",
                                        fill: false,
                                        data: [
                                            @foreach($budgets as $budget)
                                                '{{$budget->amount}}',
                                            @endforeach
                                        ],
                                        borderColor: '#F96332',
                                        segment: {
                                            borderColor: ctx => futureLineColor(ctx),
                                            borderDash: ctx => futureLineDashStyle(ctx, [6,6]),
                                        },
                                        yAxisID: 'y1'
                                    },
                                    {
                                        label: "{{__('promotionUrl.total_budget')}}",
                                        fill: false,
                                        data: [
                                            @foreach($promotionUrlsTotalPrices as $total)
                                                '{{$total}}',
                                            @endforeach
                                        ],
                                        borderColor: '#183659',
                                    },
                                    {
                                        label: "{{__('title.new_blogs')}}",
                                        fill: false,
                                        data: [
                                            @foreach($blogsAmount as $amount)
                                                '{{$amount}}',
                                            @endforeach
                                        ],
                                        borderColor: '#0026FF',
                                        yAxisID: 'y2'
                                    },
                                    {
                                        label: "{{__('title.new_backlinks')}}",
                                        fill: false,
                                        data: [
                                            @foreach($backlinksAmount as $amount)
                                                '{{$amount}}',
                                            @endforeach
                                        ],
                                        borderColor: '#B200FF',
                                        yAxisID: 'y2'
                                    },
                                    {
                                        label: "{{__('title.accepted_promotion_urls')}}",
                                        fill: false,
                                        data: [
                                            @foreach($acceptedPromotionUrlsAmount as $amount)
                                                '{{$amount}}',
                                            @endforeach
                                        ],
                                        borderColor: '#00FF21',
                                        yAxisID: 'y2'
                                    },
                                    {
                                        label: "{{__('title.denied_promotion_urls')}}",
                                        fill: false,
                                        data: [
                                            @foreach($deniedPromotionUrlsAmount as $amount)
                                                '{{$amount}}',
                                            @endforeach
                                        ],
                                        borderColor: '#FF0000',
                                        yAxisID: 'y2'
                                    },
                                ]
                            },
                            options: {
                                scales: {
                                    y1: {
                                        beginAtZero: true,
                                        display: true,
                                        position: 'left'
                                    },
                                    y2: {
                                        beginAtZero: true,
                                        display: true,
                                        position: 'right',
                                        ticks: {
                                            stepSize: 10
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
