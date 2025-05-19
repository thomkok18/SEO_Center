<x-app-layout
    :active-page="'seo_create_website'"
    :css="asset('css/seo/customers/websites/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.create_website') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('websiteError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('websiteError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.customers.websites.store', ['customer' => $company_id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="url">{{__('website.url')}}</x-label>
                                        <input id="url" class="form-control" type="text" name="url" :value="old('url')" placeholder="https://www.google.com" required autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <x-label for="startdate">{{__('budget.start_date')}}</x-label>
                                        <input id="startdate" class="form-control" type="month" name="startdate" :value="old('startdate')" required autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <x-label for="enddate">{{__('budget.end_date')}}</x-label>
                                        <input id="enddate" class="form-control" type="month" name="enddate" :value="old('enddate')" required autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <x-label for="amount">{{__('budget.amount')}}</x-label>
                                        <input id="amount" class="form-control" type="number" min="0" step="0.01" name="amount" :value="old('amount')" required autofocus/>
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
