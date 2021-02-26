<div class="col-sm-6" id="list-{{$list->id}}">
    <div class="card">
        <div class="card-body one-list">
            <h5 class="card-title">{{$list->title}}</h5>
            <p class="card-text">{{$list->description}}</p>
            <a href="{{ route('list', ['id' => $list->id]) }}" class="btn btn-primary">Переглянути</a>
            <i class="mdi mdi-delete remove-list" data-id="{{$list->id}}"></i>
        </div>
    </div>
</div>