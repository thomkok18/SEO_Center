<x-app-layout
    :active-page="'dashboard_supplier'"
    :css="asset('css/dashboards/supplier.min.css')"
    :font-awesome="true"
>
    <div class="card">
        <div class="card-header" style="padding-bottom: 25px;">
            <h3 class="mb-0">{{ __('webpage.Dashboard') }}</h3>
        </div>
    </div>

    <div class="container d-flex flex-column justify-content-center" style="min-height: inherit">
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.new_blog_checks')}}" role="alert" href="{{route('supplier.promotion-urls.index')}}/search?_token=X4iSvqxeqCS3Nwo5xNkc96sjQdW0gXB6j1HIq4gx&search=&url_type_id=1&conclusion_ids%5B%5D=3&conclusion_ids%5B%5D=4&conclusion_ids%5B%5D=5&conclusion_ids%5B%5D=6&conclusion_ids%5B%5D=7&conclusion_ids%5B%5D=8&conclusion_ids%5B%5D=9&conclusion_ids%5B%5D=10&checked=&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newAssessedBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newAssessedBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newAssessedBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_blog_assessments', count($newAssessedBlogs), ['items' => count($newAssessedBlogs)])}}
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.new_backlink_checks')}}" role="alert" href="{{route('supplier.promotion-urls.index')}}/search?_token=X4iSvqxeqCS3Nwo5xNkc96sjQdW0gXB6j1HIq4gx&search=&url_type_id=2&conclusion_ids%5B%5D=3&conclusion_ids%5B%5D=4&conclusion_ids%5B%5D=5&conclusion_ids%5B%5D=6&conclusion_ids%5B%5D=7&conclusion_ids%5B%5D=8&conclusion_ids%5B%5D=9&conclusion_ids%5B%5D=10&checked=&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newAssessedBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newAssessedBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newAssessedBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_backlink_assessments', count($newAssessedBacklinks), ['items' => count($newAssessedBacklinks)])}}
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.total_budget_left')}}" role="alert" href="{{route('dashboard')}}#budgetsLeft">
                    <div class="d-flex justify-content-center align-items-center">
                        @if($totalBudgetLeft >= 2500)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif($totalBudgetLeft >= 1000)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif($totalBudgetLeft < 1000)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{__('notification.add_new_blogs_or_backlinks', ['value' => $totalBudgetLeft])}}
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 id="budgetsLeft" class="mb-0">{{ __('webpage.customer_website_budgets') }}</h3>
        </div>

        <div class="card-body">
            <div class="col-12 p-0">
                @forelse($websites as $website)
                    <div class="border mb-2 mb-xl-0 p-2">
                        <div class="d-flex align-items-center justify-content-between">
                            <div title="{{trans_choice('promotionUrl.customer_website', 1)}}">{{$website->url}}</div>
                            <div class="d-flex align-items-center">
                                <div title="{{__('title.customer_budget_left')}}">&euro; {{\App\Models\Budget::getWebsiteBudget($website->id)}}</div>
                                <a class="ml-4" href="{{route('supplier.websites.budgets.index', $website->id)}}" aria-label="{{__('title.website_budget_overview')}}" title="{{__('title.website_budget_overview')}}">
                                    <i class="fas fa-book fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div>
                        {{__('pagination.websites_not_found')}}
                    </div>
                @endforelse
                <div
                    @if(!$websites->isEmpty()) class="mt-2"> {{$websites->links()}} @else > @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
