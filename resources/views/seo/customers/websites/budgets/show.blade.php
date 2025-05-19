<x-app-layout
    :active-page="'seo_show_website_budget'"
    :css="asset('css/seo/customers/websites/budgets/show.min.css')"
    :font-awesome="true"
>
    <script src="{{asset('../assets/js/plugins/chartjs.min.js')}}"></script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.website_budgets_overview') }}</h3>
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="m-0" title="{{__('title.customer_budget_left')}}">&euro; {{$websiteBudgetLeft}}</h4>
                        <x-nav-link class="p-0 py-2 pr-3" :href="route('seo.customers.websites.budgets.create', ['customer' => $customer_id, 'website' => $website->id])" :active="request()->routeIs('seo.customers.websites.budgets.create', ['customer' => $customer_id, 'website' => $website->id])" aria-label="{{__('title.add_budget')}}" title="{{__('title.add_budget')}}">
                            <i class="fas fa-plus fa-2x"></i>
                        </x-nav-link>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status')['storeBudget'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeBudget'] }}
                        </div>
                    @endif
                    @if (session('status')['updateBudget'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateBudget'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('budgetError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('budgetError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                                        yAxisID: 'y1'
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

    <div class="row">
        <div class="col-12">
            @forelse($budgets as $budget)
                <div class="row">
                    <div class="col-12">
                        <div class="bg-white shadow mb-2 p-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-content-center justify-content-between">
                                    <div>
                                        <div title="{{__('budget.start_date')}}">{{$budget->date}}</div>
                                        <div title="{{__('budget.amount')}}">€ {{$budget->amount}}</div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        @if(new DateTime($budget->date) > now())
                                            <x-nav-link class="ml-2 p-0" :href="route('seo.customers.websites.budgets.edit', ['customer' => $customer_id, 'website' => $website->id, 'budget' => $budget->id])" :active="request()->routeIs('seo.customers.websites.budgets.edit', ['customer' => $customer_id, 'website' => $website->id, 'budget' => $budget->id])" aria-label="{{__('form.edit_budget')}}" title="{{__('form.edit_budget')}}">
                                                <i class="fas fa-edit fa-2x"></i>
                                            </x-nav-link>
                                            <a class="d-flex justify-content-center" style="width: 30px" href="#" title="{{__('form.delete_budget')}}">
                                                <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$budget->id}}"></i>
                                            </a>
                                            <x-modal
                                                :id="$budget->id"
                                                :title="$budget->date . ' - € ' . $budget->amount"
                                                :description="__('modal.delete_message', ['item' => __('modal.this_budget')])"
                                                :route="route('seo.customers.websites.budgets.destroy', ['customer' => $customer_id, 'website' => $website->id, 'budget' => $budget->id])"
                                                :method="'DELETE'"
                                            ></x-modal>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm p-2">
                    {{__('pagination.budgets_not_found')}}
                </div>
            @endforelse
            <div
                @if(!$budgets->isEmpty()) class="mt-2"> {{$budgets->links()}} @else > @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Opening and closing a modal.
        (function () {
            if (navigator.platform.startsWith('Win')) {
                $('.modal').on('show.bs.modal', () => {}).on('hide.bs.modal', () => {
                    @foreach($budgets as $index => $budget)
                        const ps_{{$index}} = new PerfectScrollbar('#modal-{{$budget->id}}');
                        ps_{{$index}}.destroy();
                    @endforeach
                });
            }
        });
    </script>
</x-app-layout>
