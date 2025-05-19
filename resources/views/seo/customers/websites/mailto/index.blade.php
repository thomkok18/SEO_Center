<x-app-layout
    :active-page="'seo_index_website_mailto'"
    :css="asset('css/seo/customers/websites/mailto/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.customer_support_mail') }}</h3>
                </div>

                <div class="card-body">
                    @if(count($mails) > 0)
                        <x-nav-link class="ml-0 p-0 pr-md-2" :href="route('seo.customers.mailto.edit', ['customer' => $customer_id])" :active="request()->routeIs('seo.customers.mailto.edit', ['customer' => $customer_id])" aria-label="{{__('title.edit_mailto')}}" title="{{__('title.edit_mailto')}}">
                            <i class="fas fa-edit fa-2x"></i>
                        </x-nav-link>
                    @else
                        <x-nav-link class="ml-0 p-0 pr-md-2" :href="route('seo.customers.mailto.create', ['customer' => $customer_id])" :active="request()->routeIs('seo.customers.mailto.edit', ['customer' => $customer_id])" aria-label="{{__('title.add_mailto')}}" title="{{__('title.add_mailto')}}">
                            <i class="fas fa-plus fa-2x"></i>
                        </x-nav-link>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status')['storeMailto'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeMailto'] }}
                        </div>
                    @endif
                    @if (session('status')['updateMailto'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateMailto'] }}
                        </div>
                    @endif
                    <div class="col-12 p-0">
                        @forelse($mails as $mail)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center">
                                    <div class="w-100" title="{{__('role.seo_employee')}}">{{$mail->email}}</div>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.customer_service_mail_not_selected')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$mails->isEmpty()) class="mt-2"> {{$mails->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
