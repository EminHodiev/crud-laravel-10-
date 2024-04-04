<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- add bootstrap css & js & jquery --}}
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Crud system - Ajax in Laravel 10</title>
</head>
<body>
{{-- lets create a view of a table with list of cars--}}
<div class="container">
    <div class="card">
        <div class="card-header">Crud system - Ajax in Laravel 10 <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addModal">add new</button></div>
        {{-- these two spans will display flash messeges--}}
        <span class="alert alert-success" id="alert-success" style="display: none;"></span>
        <span class="alert alert-danger" id="alert-danger" style="display: none;"></span>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Специальность</th>
                    <th>Дата рождения</th>
                    <th>Начало пред...</th>
                    <th>Пол</th>
                    <th colspan="2">Action</th>
                </tr>
                </thead>
                <tbody>
                    {{-- pass data from database here --}}
                    @if(count($teachers) > 0)
                    @foreach($teachers as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->surname}}</td>
                            <td>{{$item->speciality}}</td>
                            <td>{{$item->rozhdenie}}</td>
                            <td>{{$item->ogozi_dars}}</td>
                            <td>{{$item->gender}}</td>
                            <td><button class="btn btn-primary btn-sm">edit</button></td>
                            <td><button class="btn btn-danger btn-sm">delete</button></td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5">No date found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- add teacher Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- create a form here.. --}}
                <form id="addTeacherForm">
                  <div class="form-group">
                      <label for="">Teacher Name</label>
                      <input type="text" name="name" id="" class="form-control">
                      <span id="name_error" class="text-danger"></span>
                  </div>
                    <div class="form-group">
                        <label for="">Teacher surname</label>
                        <input type="text" name="surname" id="" class="form-control">
                        <span id="surname_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Teacher ogozi_dars</label>
                        <input type="number" name="ogozi_dars" id="" class="form-control">
                        <span id="ogozi_dars_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Teacher happy birthday</label>
                        <input type="date" name="rozhdenie" id="" class="form-control">
                        <span id="rozhdenie_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Teacher speciality</label>
                        <input type="text" name="speciality" id="" class="form-control">
                        <span id="speciality_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Teacher gender</label>
                        <input type="text" name="gender" id="" class="form-control">
                        <span id="gender_error" class="text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="save" class="btn btn-primary addBtn">Save changes</button>
            </div>
            {{--this is to make sure the save changes button is within form --}}
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('#addTeacherForm').submit(function (e){
            e.preventDefault();
            let formData =$(this).serialize();
            $.ajax({
                url:'{{route("addTeacherForm")}}',
                data: formData,
                contentType: false,
                proccessData: false,
                beforeSend:function(){
                    $('.addBtn').prop('disabled', true);
                },
                complete: function(){
                    $('.addBtn').prop('disabled', false);
                },
                success: function (data){
                    if(data.success == true){
                        location.reload();
                        printSuccessMsg(data.msg);
                    }else if(data.success == false){
                        printErrorMsg(data.msg);
                    }else{
                        printValidationErrorMsg(data.msg);
                    }
                }
            });
            return false;
            //the there functions for flash messages
            function printValidationErrorMsg(msg){
                $.each(msg, function (field_name, error) {
                    // console.log(field_name, error);
                    //this will find a input id for error lets create this
                    $(document).find('#' +field_name+ '_error').text(error);
                });
                }
                function printErrorMsg(msg){
                $('#alert-danger').html('');
                $('#alert-danger').css('display','block');
                $('#alert-danger').append(''+msg+'');
            }
                function printSuccessMsg(msg){
                    $('#alert-success').html('');
                    $('#alert-success').css('display','block');
                    $('#alert-success').append(''+msg+'');
                    // if form successfully submitted reset form
                    document.getElementById('addTeacherForm').reset();
                }
        });
    });
</script>
</body>
</html>
