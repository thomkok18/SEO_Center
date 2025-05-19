<x-app-layout
    :active-page="'admin_edit_user'"
    :css="asset('css/admin/users/edit.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{$user->email}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['updateAccount'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['updateAccount'] }}
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
                        <form class="w-100" method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="firstname">{{__('user.first_name')}}</x-label>
                                        <x-input id="firstname" type="text" name="firstname" value="{{$user->firstname}}" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="inserts">{{__('user.inserts')}}</x-label>
                                        <x-input id="inserts" type="text" name="inserts" value="{{$user->inserts}}" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="lastname">{{__('user.last_name')}}</x-label>
                                        <x-input id="lastname" type="text" name="lastname" value="{{$user->lastname}}" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="phone">{{__('user.phone_number')}}</x-label>
                                        <x-input id="phone" type="text" name="phone" value="{{$user->phone}}" autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="email">{{__('user.email')}}</x-label>
                                        <x-input id="email" type="email" name="email" value="{{$user->email}}" required autofocus />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="company_id">{{__('user.company')}}</x-label>
                                        <select id="company_id" class="form-control" name="company_id" required autofocus>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}" @if($company->id === $user->company_id) selected @endif>{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="language_id">{{__('user.language')}}</x-label>
                                        <select id="language_id" class="form-control" name="language_id" required autofocus>
                                            @foreach($languages as $language)
                                                <option value="{{$language->id}}" @if($language->id === $user->language_id) selected @endif>{{$language->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="role_id">{{__('user.role')}}</x-label>
                                        <select id="role_id" class="form-control" name="role_id" required autofocus>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if($role->id === $user->role_id) selected @endif>{{__('role.' . $role->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="status_id">{{__('user.status')}}</x-label>
                                        <select id="status_id" class="form-control" name="status_id" required autofocus>
                                            @foreach($statuses as $status)
                                                <option value="{{$status->id}}" @if($status->id === $user->status_id) selected @endif>{{__('user_status.' . $status->name)}}</option>
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
