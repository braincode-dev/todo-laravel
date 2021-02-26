<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('profile.partials.head')
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('profile.partials.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/sidebar.blade -->
        @include('profile.partials.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            @include('profile.partials.footer')
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<!-- Modal -->
<div class="modal fade" id="createNewList" data-backdrop="static" data-keyboard="false" tabindex="-1"
     aria-labelledby="createNewList" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Створення нового списку</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-list-form">
                    @csrf
                    <input type="hidden" value="{{auth()->user()->id}}" name="user_id">
                    <div class="form-group">
                        <input type="text" name="title" placeholder="title" class="form-control" id="title-list" aria-describedby="title-list">
                        <span class="error-text"></span>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="description" placeholder="description" id="description-list" rows="5"></textarea>
                        <span class="error-text"></span>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Закрити</button>
                <button type="submit" class="btn btn-create btn-sm create-list-btn">Створити</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- container-scroller -->
@include('profile.partials.main-scripts')
@yield('profile-scripts')
</body>
</html>
