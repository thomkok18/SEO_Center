<x-app-layout
    :active-page="'admin_index_crawler_mailto'"
    :css="asset('css/admin/links/mailto/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-3">{{ __('webpage.link_crawler_mails') }}</h3>
                </div>

                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link class="ml-0 p-0 pr-md-2" :href="route('admin.mailto_link.create')" :active="request()->routeIs('admin.mailto_link.create')" aria-label="{{__('title.add_mailto_admin')}}" title="{{__('title.add_mailto_admin')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('admin.mailto_link.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_mailto_admin')}}" autofocus/>
                                </div>
                                <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
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
                                    <div class="w-100" title="{{__('user.email')}}">{{$mail->email}}</div>
                                    <x-nav-link class="ml-2 p-0" :href="route('admin.mailto_link.edit', ['mailto_link' => $mail->id])" :active="request()->routeIs('admin.mailto_link.edit', ['mailto_link' => $mail->id])" aria-label="{{__('title.edit_mailto_admin')}}" title="{{__('title.edit_mailto_admin')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                    <a class="d-flex justify-content-center" style="width: 30px" href="#" title="{{__('form.delete_budget')}}">
                                        <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$mail->id}}"></i>
                                    </a>
                                    <x-modal
                                        :id="$mail->id"
                                        :title="$mail->email"
                                        :description="__('modal.delete_message', ['item' => $mail->email])"
                                        :route="route('admin.mailto_link.destroy', ['mailto_link' => $mail->id])"
                                        :method="'DELETE'"
                                    ></x-modal>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.crawler_emails_not_found')}}
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
