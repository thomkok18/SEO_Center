<x-app-layout
    :active-page="'seo_edit_customer'"
    :css="asset('css/seo/customers/edit.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.edit_customer') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updateCompany'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateCompany'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('companyError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('companyError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.customers.update', ['customer' => $company->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="name">{{__('company.name')}}</x-label>
                                        <input id="name" class="form-control" type="text" name="name" value="{{$company->name}}" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="d-flex flex-column">
                                        <x-label for="archived">{{__('company.archived')}}</x-label>
                                        <input type="hidden" name="archived" value="0">
                                        <input id="archived" class="bootstrap-switch" type="checkbox" name="archived" value="1" @if($company->archived) checked @endif data-on-label="<i class='now-ui-icons ui-1_check'></i>" data-off-label="<i class='now-ui-icons ui-1_simple-remove'></i>" autofocus />
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
