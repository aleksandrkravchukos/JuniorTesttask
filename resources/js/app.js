require('datatables.net');
const stringifySafe = require('json-stringify-safe');
window.$ = window.jQuery = require('jquery');

class userApp {
    constructor() {
        console.log('Hello, TMG!');
        this.url = '/users/';
        this._token = $('meta[name="csrf-token"]').attr('content')
        this.activeId = 0;
    }

    test() {
        console.log('This is a loading test Jquery');
        try {
            $('#vmenu').css('background-color', 'lightgreen');
            return true;
        } catch (e) {
            return e.errors
        }
    }

    clearForm() {
        $('#myModalCreate input').val('');
        $('#myModal input').val('');
    }

    validateCreateUser() {
        let errors = [];
        let isValid = true;
        let name = $('input[name="name"]').val();
        let email = $('input[name="email"]').val();
        let phone = $('input[name="phone"]').val();
        let password = $('input[name="password"]').val();
        let password2 = $('input[name="password2"]').val();

        if (name.trim() === '') {
            isValid = false;
            errors.push({error: 'Name not valid'});
        }

        if (email.trim() === '') {
            isValid = false;
            errors.push({error: 'Email not valid'});
        }

        if (phone.trim() === '') {
            isValid = false;
            errors.push({error: 'Phone not valid'});
        }

        if (password.trim() === '') {
            isValid = false;
            errors.push({error: 'Password2 not valid'});
        }

        if (password2.trim() === '') {
            isValid = false;
            errors.push({error: 'Password not valid'});
        } else if (password !== password2) {
            errors.push({error: 'Password2 not valid'});
            isValid = false;
        }

        if (isValid) {
            console.log('Validation success');
            return true;
        }

        return errors;
    }

    users(page) {
        console.log('Get existing users..');

        let data = {
            _token: this._token,
            url: this.url + 'index',
            page: page,
        }

        $.ajax({
            url: this.url + 'index',
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    app.table.clear();
                    app.table.rows.add(data).draw();
                }
                $(".openModal").click(function (e) {
                    let id = e.target.id;
                    app.activeId = id;
                    app.user(id);
                    $("#myModal").css("display", "block");
                });

                $(".openModalCreate").click(function (e) {
                    app.clearForm()
                    $("#myModalCreate").css("display", "block");
                });

                $(".deleteModal").click(function (e) {
                    app.activeId = e.target.id;
                    app.deleteUser();
                });

                $(".close, .modal").click(function () {
                    $("#myModal").css("display", "none");
                    $("#myModalCreate").css("display", "none");
                });

                $(".updateUserData").click(function () {
                    $("#myModal").css("display", "none");
                    app.updateUser();
                });

                $(".createUserData").click(function () {
                    app.addUser(app.table);
                });

                $(".createUserDataCancel").click(function () {
                    $("#myModal").css("display", "none");
                    $("#myModalCreate").css("display", "none");
                });

                $(".modal-content").click(function (e) {
                    e.stopPropagation();
                });
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong.',
                    text: 'Response with error ' + '"' + xhr.responseText + '"'
                });
            }
        });
    }

    user() {
        console.log('Get user by id = ' + this.activeId);
        app.clearForm();
        $.ajax({
            url: this.url + this.activeId,
            type: 'GET',
            data: {
                _token: this._token,
                id: this.activeId
            },
            success: function (response) {
                $('#user_name').val(response.name)
                $('#user_email').val(response.email)
                $('#user_phone').val(response.phone)
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Update failed.',
                    text: xhr.responseText
                });
            }
        });
    }

    updateUser() {
        let data = {
            url: this.url + this.activeId,
            _token: this._token,
            name: $('#user_name').val(),
            email: $('#user_email').val(),
            phone: $('#user_phone').val(),
            password: $('#user_password').val(),
            text: 'User updated',
            method: 'PATCH',
            modal: 'myModal',
            id: this.activeId
        }
        this.makeRequest(data)
    }

    deleteUser() {
        Swal.fire({
            title: "Please type 'DELETE' for confirm",
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Submit',
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                if (name) {
                    console.log(`Entered name: ${name}`);
                }
            }
        }).then((result) => {
            if (result.isConfirmed && result.value === 'DELETE') {
                console.log('Admin confirmed deleting user');
                let data = {
                    url: this.url + this.activeId,
                    _token: this._token,
                    text: 'User deleted',
                    method: 'DELETE',
                    modal: '',
                    id: this.activeId
                }
                this.makeRequest(data)
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'It looks like you are a bot...',
                    text: "Deleting doesn't confirm"
                });
            }
        });
    }

    addUser() {
        let validation = this.validateCreateUser();
        console.log(validation);
        if (validation === true) {
            let data = {
                url: this.url + 'create',
                _token: this._token,
                name: $('#user_name_c').val(),
                email: $('#user_email_c').val(),
                phone: $('#user_phone_c').val(),
                password: $('#user_password_c').val(),
                text: 'User created',
                method: 'POST',
                modal: 'myModalCreate'
            }
            this.makeRequest(data)
        } else {
            let icon = 'warning';
            let title = 'Validation error';
            let jsonErrorMessage = stringifySafe(validation);
            Swal.fire({
                icon: icon,
                title: title,
                text: jsonErrorMessage
            });
        }
    }

    makeRequest(data) {
        $.ajax({
            url: data.url,
            type: data.method,
            data: data,
            success: function (response) {
                console.log(response + response.length);
                if (data.modal !== '') {
                    $("#" + data.modal + "").css("display", "none");
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Done.',
                    text: data.text
                });
                app.users(0);
            },
            error: function (xhr, status, error) {
                if (data.modal !== '') {
                    $("#" + data.modal + "").css("display", "block");
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Something went wrong.',
                    text: 'Response with error ' + '"' + xhr.responseText + '"'
                });
            }
        });
    }

    init() {
        this.users(0);
        console.log('Initialization completed.');
    }
}

let app = new userApp();
let Swal = require('sweetalert2');
app.init();
app.table = $('#userTable').DataTable({
    columnDefs: [
        {"width": "20px", "targets": 0, className: "dt-head-left"},
        {"width": "200px", "targets": 1, className: "dt-head-left"},
        {"width": "220px", "targets": 2, className: "dt-head-left"},
        {"width": "150px", "targets": 3, className: "dt-head-left"},
    ],
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'email'},
        {data: 'phone'},
        {data: 'make'},
    ],
    lengthMenu: [10, 20, 50],
    responsive: false,
    autoFill: true,
    colReorder: true,
    order: [[0, 'desc']],
    keys: {
        columns: ':not(:first-child)'
    },
    select: {
        style: 'os',
        selector: 'td:first-child',
        blurable: true
    },
    rowReorder: false,
    createdRow: function (row, data, dataIndex) {
        //$(row).addClass('greenClass').removeClass('odd');
    },
    color: "green"
});
