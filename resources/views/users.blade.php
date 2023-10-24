@extends('layout.users')
@section('title', 'Users. CRUD test task')

@push('custom-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

@endpush
@section('user-content')

    <div id="myModal" class="modal">
        <div class="modal-content" style="width: 500px;height:600px;">
            <span class="close">&times;</span>
            <h2>Edit user data</h2>
            <div class="form-group">
                <label for="user_name">Name</label>
                <input type="text" id="user_name" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" id="user_email" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="user_phone">Phone</label>
                <input type="text" id="user_phone" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="user_password">Password</label>
                <input type="password" id="user_password" required style="width: 450px;">
            </div>
            <div id="buttons">
                <button class="createUserDataCancel" style="background-color:lightblue;position:absolute;width: 140px;">
                    Close
                </button>
                <button class="updateUserData" style="float:right;margin-left:400px;width: 140px;">Update data</button>
            </div>
        </div>
    </div>

    <div id="myModalCreate" class="modal">
        <div id="create" class="modal-content" style="width: 500px;height:700px;">
            <span class="close">&times;</span>
            <h2>Add user</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="user_name_c" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="user_email_c" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="user_phone_c">Phone</label>
                <input type="text" id="user_phone_c" name="phone" style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="user_password_c" name="password" required style="width: 450px;">
            </div>
            <div class="form-group">
                <label for="password">Repeat password</label>
                <input type="password" id="user_password_c_2" name="password2" required style="width: 450px;">
            </div>
            <div id="buttons">
                <button class="createUserDataCancel" style="background-color:lightblue;position:absolute;width: 140px;">
                    Close
                </button>
                <button class="createUserData" style="margin-left:100px;float:right;width: 240px;">Create</button>
            </div>
        </div>
    </div>

    <div>
        <div class="main-content">
            <div class="top-panel">
                List of users. <span style="cursor: pointer" class="openModalCreate buttonCreate"><img
                        style="width:20px;" src="/images/add_user.png"> </span>
            </div>
            <table id="userTable" class="display">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Make</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
@endsection
