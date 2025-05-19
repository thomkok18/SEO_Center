<x-app-layout
    :active-page="'seo_edit_website_competitors'"
    :css="asset('css/seo/customers/websites/competitors/edit.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.edit_competitor') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updateCompetitor'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateCompetitor'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('competitorError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('competitorError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.customers.competitors.update', ['customer' => $customer_id, 'competitor' => $competitor->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="url">{{__('website.url')}}</x-label>
                                        <input id="url" class="form-control" type="text" name="url" value="{{$competitor->url}}" placeholder="https://www.google.com" required autofocus/>
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
