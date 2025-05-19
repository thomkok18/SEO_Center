<div id="modal-{{$id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">{{$title}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{$description}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('form.cancel')}}</button>

                @if($route)
                    <form class="w-100" method="POST" action="{{ $route }}">
                        @if(!empty($method))
                            @method($method)
                        @endif

                        @csrf
                        @if($method === 'DELETE')
                            <button type="submit" class="btn btn-primary">{{__('form.delete')}}</button>
                        @elseif($method === 'PUT' || $method === 'PATCH')
                            <button type="submit" class="btn btn-primary">{{__('form.edit')}}</button>
                        @endif
                    </form>
                @else
                    <button type="submit" class="btn btn-primary">{{__('form.save')}}</button>
                @endif
            </div>
        </div>
    </div>
</div>
