<x-app-layout
    :active-page="'admin_create_crawler_mailto'"
    :css="asset('css/admin/links/mailto/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.add_email') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('mailtoError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('mailtoError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('admin.mailto_link.store') }}">
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
                                        <x-label for="email">{{__('user.email')}}</x-label>
                                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
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
