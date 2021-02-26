@extends('layouts.profile')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
            </span> Пошук завдань</h3>
    </div>
    @include('profile.components.info')
    <div class="row">
        <div class="col-3 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Фільтр тегів</h4>
                    <hr>
                    <form action="{{route('search')}}" method="get">
                        @if(!$lists->isEmpty())
                            @foreach($lists as $list)
                                <div class="form-check-inline w-chexbox-permission mb-2 mr-1">
                                    <input @foreach($tasksSearch as $taskSearch)
                                           @if($taskSearch == $list->id) checked @endif
                                           @endforeach
                                           class="form-check-input" type="checkbox" name="lists[]"
                                           id="search_tag_{{$list->id}}" value="{{$list->id}}">

                                    <label class="form-check-label bg-gradient-danger btn btn-sm search_tag_filtr"
                                           for="search_tag_{{$list->id}}">{{$list->title}}</label>
                                </div>
                            @endforeach
                        @else
                            <p class="text-danger">Списків не знайдено</p>
                        @endif
                        <button class="btn-sm btn btn-gradient-info d-block mt-5">Застосувати</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4>Результати (@if($searchResult->isNotEmpty()) {{$searchResult->count()}} @endif )</h4>
                    <hr>
                    @if(!$searchResult->isEmpty())
                        <div class="row">
                            @foreach($searchResult as $task)
                                <div class="col-md-3 search-bl">
                                    <div class="d-block link-search-page">

                                        <h4>{{$task->title}}</h4>
                                        <p class="list-title-search">Список: <a
                                                    href="{{ route('list', ['id' => $task->list_id])}}">{{$task->list_title}}</a>
                                        </p>

                                        @if($task->is_done == 1)

                                            <i class="mdi mdi-check done" title="Виконане завдання"></i>
                                        @else
                                            <i class="mdi mdi-close not-done" title="Не виконане завдання"></i>
                                        @endif
                                        <div class="created-date">
                                            Створено: {{\Carbon\Carbon::parse($task->created_at)->format('d.m.Y H:i')}}</div>

                                    </div>
                                </div>
                            @endforeach
                            <div class="mt-5 d-flex w-100 justify-content-center">
                                {{--{{$searchResult->appends(request())->links()}}--}}
                            </div>
                        </div>
                    @else
                        <p>Результатів не знайдено!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

