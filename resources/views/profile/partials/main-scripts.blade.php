<!-- plugins:js -->
<script src="{{url('/js/profile/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{url('/js/profile/Chart.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{url('/js/profile/off-canvas.js')}}"></script>
<script src="{{url('/js/profile/hoverable-collapse.js')}}"></script>
<script src="{{url('/js/profile/misc.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{url('/js/profile/dashboard.js')}}"></script>
<script src="{{url('/js/profile/todolist.js')}}"></script>
<!-- End custom js for this page -->

<script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#close-search-bl').on('click', function(e){
        e.preventDefault();
        $('.ajax-list').hide();
    })

    $('.select-from-all-project').selectpicker();

    $('#searchHome').on('keyup', function () {

        $.ajax({
            type: "GET",
            url: '/profile/search',
            data: {text: $('#searchHome').val()},
            success: function (res) {

                if($.isEmptyObject(res)){
                    var link = "<li class='none-before'><a href='#' class='disabled link-search'>Результатів не найдено</a></li>";
                    $('#resultSearchHome').html(link);
                    $('.ajax-list').show();
                }else{
                    $('#resultSearchHome').html('');
                    for (var item of res) {
                        var link = "<li><a href='/profile/list/"+item.todo_list_id+"' class='link-search'>"+item.title+"</a></li>";
                        $('.ajax-list').show();
                        $('#resultSearchHome').append(link);
                    }
                }

                if($('#searchHome').val() == ''){
                    $('.ajax-list').hide();
                    $('#resultSearchHome').html('');
                }
            }

        });

    });
</script>
