<x-app-layout
    :active-page="'admin_edit_link'"
    :css="asset('css/admin/links/edit.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{$link->website}}</h3>
                </div>

                <div class="card-body">
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
                        <form class="w-100" method="POST" action="{{ route('admin.links.update', ['link' => $link->id]) }}">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="website">{{__('link.website')}}</x-label>
                                        <x-input id="website" type="text" name="website" value="{{$link->website}}" placeholder="https://wwww.google.nl/item" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="anchor_text">{{__('link.anchor_text')}}</x-label>
                                        <x-input id="anchor_text" type="text" name="anchor_text" value="{{$link->anchor_text}}" placeholder="item" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="anchor_url">{{__('link.anchor_url')}}</x-label>
                                        <x-input id="anchor_url" type="text" name="anchor_url" value="{{$link->anchor_url}}" placeholder="https://wwww.your-website.nl/item" required autofocus/>
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
