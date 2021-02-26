<div class="form-group form-check one-task-w" id="task-{{$task->id}}">
    <input type="checkbox" @if($task->is_done) checked @endif class="form-check-input task"
           id="task{{$task->id}}" data-id="{{$task->id}}">
    <label class="form-check-label @if($task->is_done) checked @endif" for="task{{$task->id}}">{{$task->title}}</label>
    <i class="mdi mdi-delete remove-task" data-id="{{$task->id}}"></i>
</div>