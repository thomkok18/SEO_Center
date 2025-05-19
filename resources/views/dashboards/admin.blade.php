<x-app-layout
    :active-page="'dashboard_admin'"
    :css="asset('css/dashboards/admin.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.Dashboard') }}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeAccount'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeAccount'] }}
                        </div>
                    @endif
                    @if (session('status')['destroyAccount'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['destroyAccount'] }}
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
                        <div class="d-flex">
                            <x-nav-link :href="route('users.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('users.create')" aria-label="{{__('title.add_user')}}" title="{{__('title.add_user')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('admin.users.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_user')}}" autofocus/>
                                </div>
                                <div class="form-group mb-md-0 mr-md-2">
                                    <select id="role_id" class="form-control" name="role_id" title="{{__('title.filter_user_roles')}}" autofocus>
                                        <option value="">{{__('form.all_roles')}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if($role->id === intval(request('role_id'))) selected @endif>{{__('role.' . $role->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-md-0 mr-md-2">
                                    <select id="status_id" class="form-control" name="status_id" title="{{__('title.filter_user_statuses')}}" autofocus>
                                        <option value="">{{__('form.all_statuses')}}</option>
                                        @foreach($statuses as $status)
                                            <option value="{{$status->id}}" @if($status->id === intval(request('status_id'))) selected @endif>{{__('user_status.' . $status->name)}}</option>
                                        @endforeach
                                    </select>
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
                        @forelse($users as $user)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-xl-flex">
                                    <div class="w-100" title="{{__('user.email')}}">{{$user->email}}</div>
                                    <div class="w-100" title="{{__('user.name')}}">{{$user->firstname}} {{$user->inserts}} {{$user->lastname}}</div>
                                    <div class="w-100" title="{{__('user.role')}}">{{__('role.' . $user->role)}}</div>
                                    <div class="w-50" title="{{__('user.phone_number')}}">{{$user->phone}}</div>
                                    <div class="w-25" title="{{__('user.language')}}">{{$user->language}}</div>
                                    <div class="w-50" title="{{__('user.status')}}">{{__('user_status.' .$user->status)}}</div>
                                    <x-nav-link class="ml-0 ml-xl-2 p-0" :href="route('users.edit', ['user' => $user->id])" :active="request()->routeIs('users.edit', ['user' => $user->id])" aria-label="{{__('title.edit_user')}}" title="{{__('title.edit_user')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.users_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$users->isEmpty()) class="mt-2"> {{$users->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
