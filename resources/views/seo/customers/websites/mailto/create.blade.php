<x-app-layout
    :active-page="'seo_create_website_mailto'"
    :css="asset('css/seo/customers/websites/mailto/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.mailto') }}</h3>
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
                        <form class="w-100" method="POST" action="{{ route('seo.customers.mailto.store', ['customer' => $customer_id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group d-flex flex-column">
                                        <label for="user_id">{{$customer->name}}</label>
                                        <select id="user_id" class="selectpicker" data-style="btn btn-info btn-round" name="user_ids[]" data-size="10" multiple required autofocus>
                                            <option value="" selected>{{__('form.all_seo_emails')}}</option>
                                            @foreach($seo_users as $seo_user)
                                                <option value="{{$seo_user->id}}">{{$seo_user->email}}</option>
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
</x-app-layout>
