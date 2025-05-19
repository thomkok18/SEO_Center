<x-app-layout
    :active-page="'admin_index_link'"
    :css="asset('css/admin/links/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.link_crawler')}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeLink'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeLink'] }}
                        </div>
                    @endif
                    @if (session('status')['destroyLink'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['destroyLink'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('linkError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('linkError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link :href="route('admin.links.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('admin.create_link')" aria-label="{{__('title.add_link')}}" title="{{__('title.add_link')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.links.import')" class="p-0 py-2 pr-3" :active="request()->routeIs('admin.links.import')" aria-label="{{__('title.import_link')}}" title="{{__('title.import_link')}}">
                                <i class="fas fa-file-import fa-2x"></i>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.mailto_link.index')" class="p-0 py-2 pr-3" :active="request()->routeIs('admin.mailto_link.index')" aria-label="{{__('title.edit_mailto_admin')}}" title="{{__('title.edit_mailto_admin')}}">
                                <i class="fas fa-mail-bulk fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('admin.links.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_link')}}" autofocus/>
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
                    <div class="col-12 p-0">
                        @forelse($links as $link)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center">
                                    <div class="w-100" title="{{__('link.website')}}">{{$link->website}}</div>
                                    <div class="w-100" title="{{__('link.anchor_text')}}">{{$link->anchor_text}}</div>
                                    <div class="w-100" title="{{__('link.anchor_url')}}">{{$link->anchor_url}}</div>
                                    <x-nav-link class="ml-2 p-0" :href="route('admin.links.edit', ['link' => $link->id])" :active="request()->routeIs('admin.edit_link', ['id' => $link->id])" aria-label="{{__('title.edit_link')}}" title="{{__('title.edit_link')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                    <div>
                                        <a class="ml-2" aria-label="{{__('title.delete_link')}}" href="#" title="{{__('title.delete_link')}}">
                                            <i class="fas fa-trash fa-2x" data-toggle="modal" data-target="#modal-{{$link->id}}"></i>
                                        </a>
                                        <x-modal
                                            :id="$link->id"
                                            :title="$link->website"
                                            :description="__('modal.delete_message', ['item' => $link->website])"
                                            :route="route('admin.links.destroy', $link->id)"
                                            :method="'DELETE'"
                                        ></x-modal>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.links_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$links->isEmpty()) class="mt-2"> {{$links->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
