@extends('layouts/app')

@section('content')

<div class="container">
    <div class="col-md-6">

        @if ( !is_null(request('id')) && request('action')  == 'edit' )
        <h2>edit task</h2>
    <form id="edit_task{{$editTable->id}}"  method="POST" action="{{url('tasks/'.$editTable->id)}}" >
                {{csrf_field()}}
                <div class="form-group">
                  <label for="exampleInputEmail1">name</label>
                  <input name="name" type="text" class="form-control {{$errors->has('name') ? ' has-error' : ''}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <p>{{$errors->first('name')}}</p>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">descdription</label>
                  <textarea name="description"  id="" class="form-control {{$errors->has('description') ? ' has-error' : ''}}" cols="3" rows="1"></textarea>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <p>{{$errors->first('description')}}</p>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Task</button>
              </form>    
        @endif

        


              <br><br><br>
        <h2>new task</h2>
    <form method="POST" action="{{route('tasks')}}" >
        {{csrf_field()}}
        <div class="form-group">
          <label for="exampleInputEmail1">name</label>
          <input name="name" type="text" class="form-control {{$errors->has('name') ? ' has-error' : ''}}" id="exampleInputEmail1" aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="help-block">
                    <p>{{$errors->first('name')}}</p>
                </span>
            @endif
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">descdription</label>
          <textarea name="description"  id="" class="form-control {{$errors->has('description') ? ' has-error' : ''}}" cols="3" rows="1"></textarea>
            @if ($errors->has('name'))
                <span class="help-block">
                    <p>{{$errors->first('description')}}</p>
                </span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
      </form>
    

    <h1>mangement task</h1>

    <div class="col-md-6">
    <table class="table table-bordered" >
        <tr>
            <th>name</th>
            <th>description</th>
        </tr>
        
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td> 
                    <a href="{{url('/tasks')}}?action=edit&id={{$task->id}}" id="edit_task{{$task->id}}" class="pull-right">edit</a> 
                    <form action="{{url('tasks/'.$task->id)}}" method="POST" >  
                        {{csrf_field()}}
                        {{method_field('delete')}}
                    <button type="submit" name="submit" id="delete_task{{$task->id}}" >delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        
    </table>
    </div>
 </div>
</div>

    @endsection