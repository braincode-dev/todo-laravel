@extends('layouts.profile')

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
            </span> Усі списки (<span class="text-primary count-lists"> {{$lists->count()}}</span> )</h3>
        <a href="#" class="btn btn-create" data-toggle="modal" data-target="#createNewList">Створити список</a>

    </div>
    @include('profile.components.info')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row all-list">
                        @if($lists->isNotEmpty())
                            @foreach($lists as $list)
                                @include('profile.components.list', ['list' => $list])
                            @endforeach
                        @else
                            <p class="not-empty">Списків не знайдено...</p>
                        @endif
                    </div>
                </div>

                {{$lists->links()}}
            </div>
        </div>
    </div>
@endsection

@section('profile-scripts')
    <script>

        $(document).on('click', '.remove-list', function(e){
            e.preventDefault();
            let isTrue = confirm('Бажаєте видалити даний список справ, та усі його завдання?');

            if(!isTrue){
                return;
            }

            let id = $(this).data('id');
            $.ajax({
                type:'POST',
                url:'/profile/list/remove',
                data: {id, _token: '{{ csrf_token() }}'},
                success:function(data){

                    if(data.status == 'success') {
                        $(`#list-${id}`).remove();
                        $('.count-lists').text(` ${data.count} `);
                        swal({
                            title: "Успішно!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        });
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

        $('#create-list-form').on('submit', function(e){
            e.preventDefault();
            let form = $(this);

            $.ajax({
                type:'POST',
                url:'/profile/list/create',
                data: form.serialize(),
                success:function(data){
                    $('.error-text').text('');
                    $('.error-text').prev().css('border', 'none');

                    if(data.status == 'success') {

                        $('.all-list').append(data.html);
                        $('.not-empty').remove();

                        form[0].reset();
                        $("#createNewList").modal('hide');
                        swal({
                            title: "Успішно!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        });

                        var count = parseInt($('.count-lists').text()) + 1;
                        $('.count-lists').text(` ${count} `);

                    }
                },
                error: function(request){
                    $('.error-text').text('');
                    $('.error-text').prev().css('border', 'none');
                    let errors = request.responseJSON.errors;
                    for (const property in errors) {
                        let label = form.find('[name='+property+']');
                        label.next('.error-text');
                        label.css('border', '1px solid #fe7096');
                        label.next('.error-text').text(errors[property]);
                    }
                }
            });
        });
    </script>
@endsection