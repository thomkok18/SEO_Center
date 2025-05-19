<x-app-layout
    :active-page="'profile'"
    :css="asset('css/profile/show.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('form.update_profile') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updateProfile'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateProfile'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('userError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('userError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('user.info.update') }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="firstname">{{__('user.first_name')}}</x-label>
                                        <x-input id="firstname" type="text" name="firstname" value="{{auth()->user()->firstname}}" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="inserts">{{__('user.inserts')}}</x-label>
                                        <x-input id="inserts" type="text" name="inserts" value="{{auth()->user()->inserts}}" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="lastname">{{__('user.last_name')}}</x-label>
                                        <x-input id="lastname" type="text" name="lastname" value="{{auth()->user()->lastname}}" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="phone">{{__('user.phone_number')}}</x-label>
                                        <x-input id="phone" type="text" name="phone" value="{{auth()->user()->phone}}" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="email">{{__('user.email')}}</x-label>
                                        <x-input id="email" type="email" name="email" value="{{auth()->user()->email}}" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="language_id">{{__('user.language')}}</x-label>
                                        <select id="language_id" class="form-control" name="language_id" required autofocus>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}" @if($language->id === auth()->user()->language_id) selected @endif>{{$language->name}}</option>
                                            @endforeach
                                        </select>
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('form.update_password') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updatePassword'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updatePassword'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('passwordError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('passwordError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('user.password.update') }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="current_password">{{__('user.current_password')}}</x-label>
                                        <x-input id="current_password" type="password" name="current_password" :value="old('current_password')" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="new_password">{{__('user.new_password')}}</x-label>
                                        <x-input id="new_password" type="password" name="password" :value="old('new_password')" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="repeat_password">{{__('user.repeat_password')}}</x-label>
                                        <x-input id="repeat_password" type="password" name="repeat_password" :value="old('repeat_password')" required autofocus />
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
