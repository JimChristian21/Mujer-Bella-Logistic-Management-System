@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">   
        <div class="col-md-8 d-flex flex-column justify-content-between ">
            <div class="w-100">
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Name: {{ $data['first_name'] }} {{ $data['middle_name'][0] }}.  {{ $data['last_name'] }}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Birthday: {{ date('M d, Y', strtotime($data['birthdate']))}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Phone Number: {{$data['phone_number']}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Address: {{$data['street']}}, {{$data['barangay']}}, {{$data['municipality']}}, {{$data['province']}} {{$data['zip_code']}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Role: {{$data['role']}}</strong></p>
                    </div>
                </div>
            </div>

            <div class="w-100 text-center">
                <button class="btn btn-md mb-btn update-btn" type="button" data-toggle="modal" data-target="#exampleModal">Back</button>
                <button class="btn btn-md mb-btn update-btn" type="button" data-toggle="modal" data-target="#exampleModal">Update</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Update Information</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="firstName">First Name:</label>
                                <input id="firstName" class="form-control" type="text"  name="firstName" required>

                                <label for="middleName" class="mt-3">Middle Name:</label>
                                <input id="middleName" class="form-control" type="text"  name="middleName" required>

                                <label for="lastName" class="mt-3">Last Name:</label>
                                <input id="lastName" class="form-control" type="text"  name="lastName" required>

                                <label for="birthdate" class="mt-3">Birthdate:</label>
                                <input id="birthdate" class="form-control" type="date"  name="birthdate" required>

                                <label for="phoneNumber" class="mt-3">Phone Number:</label>
                                <input id="phoneNumber" class="form-control" type="text"  name="phoneNumber" required>

                                <label for="street" class="mt-3">Street:</label>
                                <input id="street" class="form-control" type="text"  name="street" required>

                                <label for="barangay" class="mt-3">Barangay:</label>
                                <input id="barangay" class="form-control" type="text"  name="barangay" required>

                                <label for="municipality" class="mt-3">Municipality/City:</label>
                                <input id="municipality" class="form-control" type="text"  name="municipality" required>

                                <label for="province" class="mt-3">Province:</label>
                                <input id="province" class="form-control" type="text"  name="province" required>

                                <label for="zipCode" class="mt-3">Zip Code:</label>
                                <input id="zipCode" class="form-control" type="text"  name="zipCode" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn mb-btn submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>
@endsection