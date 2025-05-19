<x-app-layout
    :active-page="'seo_create_customer'"
    :css="asset('css/seo/customers/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.create_customer') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('companyError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('companyError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if($errors->hasBag('customerError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('customerError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.customers.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="firstname">{{__('user.first_name')}}</x-label>
                                        <x-input id="firstname" type="text" name="firstname" :value="old('firstname')" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="inserts">{{__('user.inserts')}}</x-label>
                                        <x-input id="inserts" type="text" name="inserts" :value="old('inserts')" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="lastname">{{__('user.last_name')}}</x-label>
                                        <x-input id="lastname" type="text" name="lastname" :value="old('lastname')" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="phone">{{__('user.phone_number')}}</x-label>
                                        <x-input id="phone" type="text" name="phone" :value="old('phone')" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="email">{{__('user.email')}}</x-label>
                                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="name">{{__('user.company')}}</x-label>
                                        <x-input id="name" type="text" name="name" :value="old('name')" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="language_id">{{__('user.language')}}</x-label>
                                        <select id="language_id" class="form-control" name="language_id" :value="old('language_id')" required autofocus>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}">{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="password">{{__('user.password')}}</x-label>
                                        <x-input id="password" type="text" name="password" :value="old('password')" required autofocus />
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
