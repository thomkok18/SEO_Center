<x-app-layout
    :active-page="'dashboard_seo'"
    :css="asset('css/dashboards/seo.min.css')"
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
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.new_blogs')}}" role="alert" href="{{route('seo.promotion-urls.index')}}/search?_token=LnRtlpXaTlmaz3Gmr78DGuF6CbGIXrQj4DUlfbEl&search=&url_type_id=1&conclusion_ids%5B%5D=&checked=0&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_blogs_to_check', count($newBlogs), ['items' => count($newBlogs)])}}
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.new_backlinks')}}" role="alert" href="{{route('seo.promotion-urls.index')}}/search?_token=LnRtlpXaTlmaz3Gmr78DGuF6CbGIXrQj4DUlfbEl&search=&url_type_id=2&conclusion_ids%5B%5D=&checked=0&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_backlinks_to_check', count($newBacklinks), ['items' => count($newBacklinks)])}}
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.changed_blogs')}}" role="alert" href="{{route('seo.promotion-urls.index')}}/search?_token=LnRtlpXaTlmaz3Gmr78DGuF6CbGIXrQj4DUlfbEl&search=&url_type_id=1&conclusion_ids%5B%5D=&checked=1&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_changed_blogs', count($changedBlogs), ['items' => count($changedBlogs)])}}
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-4">
                <a class="d-flex align-items-center p-2 rounded-pill bg-white shadow-sm text-decoration-none" title="{{__('title.changed_backlinks')}}" role="alert" href="{{route('seo.promotion-urls.index')}}/search?_token=LnRtlpXaTlmaz3Gmr78DGuF6CbGIXrQj4DUlfbEl&search=&url_type_id=2&conclusion_ids%5B%5D=&checked=1&order=desc&alphabetical=desc">
                    <div class="d-flex justify-content-center align-items-center">
                        @if(count($newBlogs) >= 25)
                            <i class="far fa-times-circle fa-2x text-danger mr-2"></i>
                        @elseif(count($newBlogs) >= 15)
                            <i class="fas fa-spinner fa-2x text-warning mr-2"></i>
                        @elseif(count($newBlogs) < 15)
                            <i class="far fa-check-circle fa-2x text-success mr-2"></i>
                        @endif
                    </div>
                    <div style="color: black; font-size: large;">
                        {{trans_choice('notification.new_changed_backlinks', count($changedBacklinks), ['items' => count($changedBacklinks)])}}
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
