@extends("layouts.app")
@section("content")

    <!-- Modal Add Student -->
    <div class="modal fade" id="AddStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="saveform_errlist">

                    </ul>
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" class="name form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="text" class="email form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="text" class="phone form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Course</label>
                        <input type="text" class="course form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_student">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Student -->
    <div class="modal fade" id="EditStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="updateform_errlist"></ul>
                    <input type="hidden" id="edit_student_id"/>
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" id="edit_name" class="name form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="text" id="edit_email" class="email form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Phone</label>
                        <input type="text" id="edit_phone" class="phone form-control"/>
                    </div>
                    <div class="form-group mb-3">
                        <label>Course</label>
                        <input type="text" id="edit_course" class="course form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary update_student">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Student -->
    <div class="modal fade" id="DeleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_student_id"/>
                    <h4>Are you sure ? Want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary delete_student_btn">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-54">
        <div class="row">
            <div class="col-md-12">
                <div id="success_message">

                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Student Data
                            <a href="#" data-bs-toggle="modal" data-bs-target="#AddStudentModal"
                               class="btn btn-primary float-end btn-sm">Add Student</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Course</td>
                                <td>Edit</td>
                                <td>Delete</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>aa</td>
                                <td>
                                    <button type="button" value="" class="edit_student btn btn-primary btn-sm">Edit
                                    </button>
                                </td>
                                <td>
                                    <button type="button" value="" class="delete_student btn btn-danger btn-sm">Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("script")
    <script>
        $(document).ready(function () {

            fetchstudents();

            function fetchstudents() {
                $.ajax({
                    type: "GET",
                    url: "/fetch-student",
                    dataType: "json",
                    success: function (response) {
                        // console.log(response.students);
                        $('tbody').html("")
                        $.each(response.students, function (key, item) {
                            $('tbody').append(' <tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.name + '</td>\
                            <td>' + item.email + '</td>\
                            <td>' + item.phone + '</td>\
                            <td>' + item.course + '</td>\
                            <td><button type="button" value="' + item.id + '" class="edit_student btn btn-primary btn-sm">Edit</button></td>\
                            <td><button type="button" value="' + item.id + '" class="delete_student btn btn-danger btn-sm">Delete</button></td>\
                        </tr>')
                        });
                    }
                })
            }

            $(document).on('click', '.delete_student', function (e) {
                e.preventDefault();
                var student_id = $(this).val()
                //alert(student_id)
                $('#delete_student_id').val(student_id)
                $('#DeleteStudentModal').modal('show')
            })

            $(document).on('click', '.delete_student_btn', function (e) {
                e.preventDefault();
                $(this).text('Deleting...')
                var student_id = $('#delete_student_id').val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url:"/delete-student/"+student_id,
                    success: function (response){
                        //console.log(response)
                        $('#success_message').addClass('alert alert-success')
                        $('#success_message').text(response.message)
                        $("#DeleteStudentModal").modal('hide')
                        $('.delete_student_btn').text("Yes Delete")
                        fetchstudents()
                    }
                })
            })

            $(document).on('click', '.update_student', function (e) {
                e.preventDefault();
                $(this).text("Updating...")
                var student_id = $('#edit_student_id').val();
                var data = {
                    'name' : $('#edit_name').val(),
                    'email' : $('#edit_email').val(),
                    'phone' : $('#edit_phone').val(),
                    'course' : $('#edit_course').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"PUT",
                    url:"/update-student/"+student_id,
                    data: data,
                    dataType:"json",
                    success: function (response) {
                        //console.log(response)
                        if(response.status == 400){
                            $('#updateform_errlist').html("");
                            $('#updateform_errlist').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#updateform_errlist').append('<li>' + err_value + '</li>');
                            });
                            $('.update_student').text("Update")
                        }else if(response.status == 404){
                            $('#updateform_errlist').html("");
                            $("#success_message").addClass('alert alert-danger')
                            $("#success_message").text(response.message)
                            $('.update_student').text("Update")
                        }else {
                            $('#updateform_errlist').html("");
                            $('#success_message').html("");
                            $("#success_message").addClass('alert alert-success')
                            $("#success_message").text(response.message)
                            $('#EditStudentModal').modal('hide')
                            fetchstudents()
                        }
                    }
                })
            })

            $(document).on('click', '.edit_student', function (e) {
                e.preventDefault();
                var student_id = $(this).val();
                // console.log(student_id)
                $("#EditStudentModal").modal('show')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"/edit-student/"+student_id,
                    dataType:"json",
                    success: function (response) {
                        console.log(response)
                        if(response.status == 404){
                            $('#success_message').html("")
                            $('#success_message').addClass("alert alert-danger")
                            $('#success_message').text(response.message)
                        } else {
                            $('#edit_name').val(response.student.name);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_course').val(response.student.course);
                            $('#edit_student_id').val(student_id);
                        }
                    }
                })
            })

            $(document).on('click', '.add_student', function (e) {
                e.preventDefault();
                var data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'course': $('.course').val()
                }
                //console.log(data)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/students",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        //console.log(response);
                        if (response.status == 400) {
                            $('#saveform_errlist').html("");
                            $('#saveform_errlist').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#saveform_errlist').append('<li>' + err_value + '</li>');
                            });
                        } else {
                            $('#saveform_errlist').html("");
                            $("#success_message").addClass('alert alert-success')
                            $("#success_message").text(response.message)
                            $("#AddStudentModal").modal('hide')
                            $("#AddStudentModal").find('input').val("")
                            fetchstudents()
                        }
                    }
                })
            })
        })
    </script>
@endsection
