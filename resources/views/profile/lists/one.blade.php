@extends('layouts.profile')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
            </span> {{$list->title}}</h3>
        <a href="{{route('lists')}}" class="btn btn-create">Повернутись до усіх списків</a>

    </div>
    @include('profile.components.info')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8 tasks-col">
                            {{--new task--}}
                            <form class="mb-5" id="create-task-form">
                                <div class="input-group mb-3 wrap-create-task">
                                    @csrf
                                    <input name="list_id" type="hidden" class="form-control" value="{{$list->id}}">
                                    <input name="title" type="text" class="form-control" placeholder="Стати частиною команди Epam..." autocomplete="off">
                                    <span class="error-text"></span>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-create">Добавить</button>
                                    </div>
                                </div>
                            </form>
                            {{--new task--}}

                            <h4 class="card-title text-center">Завдання</h4>

                            <div class="tasks-wrapper">
                                @if($tasks->isNotEmpty())
                                    @foreach($tasks as $task)
                                        @include('profile.components.task', ['task' => $task])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-4">
                            <h4 class="card-title text-center">Опис вашого списку</h4>
                            <p class="card-description">{{$list->description}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('profile-scripts')
    <script>
        $(document).on('click', '.task', function (e) {
            let form = $(this);
            let id = form.data('id');

            if (form.is(':checked')) {
                var isDone = 1;
                form.next().addClass('checked');
            } else {
                var isDone = 0;
                form.next().removeClass('checked');
                // console.log(form.next());
            }

            $.ajax({
                type:'POST',
                url:'/profile/task/done',
                data: { id, _token: '{{ csrf_token() }}', isDone },
                error: function(){
                    console.log('server error')
                }
            });
        });

        $(document).on('click', '.remove-task', function(e){
            let isTrue = confirm('Бажаєте видалити дане завдання?');

            if(!isTrue){
                return;
            }

            let form = $(this);
            let id = form.data('id');
            $.ajax({
                type:'POST',
                url:'/profile/task/remove',
                data: {id, _token: '{{ csrf_token() }}'},
                success:function(data){

                    if(data.status == 'success') {
                        $(`#task-${id}`).remove();
                    }
                },
                error: function(request){
                    let errors = request.responseJSON.errors;
                    for (const property in errors) {
                        let label = form.find('input[name='+property+']').next('.error-text');
                        label.text(errors[property]);
                        return
                    }
                    console.log('server error')
                }
            });
        });

        $('#create-task-form').on('submit', function(e){
            e.preventDefault();
            let form = $(this);

            $.ajax({
                type:'POST',
                url:'/profile/task/create',
                data: form.serialize(),
                success:function(data){
                    console.log('ss');
                    if(data.status == 'success') {
                        $('.tasks-wrapper').append(data.html);
                        form.find('input[name=title]').val('');

                        // $('.not-empty').remove();
                    }
                },
                error: function(request){
                    let errors = request.responseJSON.errors;
                    for (const property in errors) {
                        let label = form.find('input[name='+property+']').next('.error-text');
                        label.text(errors[property]);
                        return
                    }
                }
            });
        });
    </script>
@endsection