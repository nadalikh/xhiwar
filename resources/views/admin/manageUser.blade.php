@extends('admin.layout.master')
@section('content')
    <table>
        <thead>
        <th>ایمیل</th>
        <th>ادمین</th>
        </thead>
        @foreach($users as $user)
            <tbody>
            <td>
                {{$user->email}}
            </td>
            <td>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="switch_category" type="checkbox" id="category_switch" onclick="changeRole('{{$user->id}}')" {{($user->role == 'admin') ? "checked": ""}}>
                </div>
            </td>
            </tbody>
        @endforeach
    </table>
@endsection

