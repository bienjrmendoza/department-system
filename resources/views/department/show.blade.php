@extends('layouts.app')

@section('content')

    <x-navbar />
    <div class="container d-flex justify-content-center">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="card data-card shadow-sm w-75 p-3">
                    <div class="card-title">
                        <h1 class="text-center my-2">Department Details</h1>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-12">
                                <h4>{{ $department->name }}</h4>
                                <p class="text-muted">{{ $department->description }}</p>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary" 
                                        data-add-employee-tooltip="tooltip" 
                                        title="Add Employee" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#addEmployeeModal">
                                            <i class="bi bi-plus"></i>
                                    </button>
                                </div>
                                @if ($employees->isNotEmpty())
                                    <table class="table table-bordered mt-2">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($employees AS $employee)
                                                <tr id="employee-{{ $employee->id }}">
                                                    <td class="employee-name">{{ $employee->name }}</td>
                                                    <td class="employee-email">{{ $employee->email }}</td>
                                                    <td class="employee-phone">{{ $employee->phone }}</td>
                                                    <td class="employee-address">{{ $employee->address }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm viewEmployeeBtn" 
                                                            data-name="{{ $employee->name }}" data-email="{{ $employee->email }}"  data-department="{{ $department->name ?? 'No Department' }}"
                                                            data-phone="{{ $employee->phone }}" data-address="{{ $employee->address }}"
                                                            data-bs-toggle="modal" data-bs-target="#viewEmployeeModal">View</button>

                                                        <!-- Update Button -->
                                                        <button href="" class="btn btn-warning btn-sm edit-employee" data-id="{{ $employee->id }}">Update</button>

                                                        <!-- Delete Button -->
                                                        <button class="btn btn-danger btn-sm delete-employee" data-id="{{ $employee->id }}">Delete</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info mt-2">No employees found!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--- ADD EMPLOYEE MODAL --->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">New Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm">
                        <input type="hidden" name="department_id" id="employeeDepartmentId" value="{{ $department->id }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control shadow-none" id="employeeName" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control shadow-none" id="employeeEmail" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control shadow-none" id="employeePhone" name="phone" placeholder="Contact Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control shadow-none" id="employeeAddress" name="address" placeholder="Address" required>
                        </div>
                        <div id="formMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary fw-medium" id="saveEmployee">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW EMPLOYEE MODAL -->
    <div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-labelledby="viewEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewEmployeeModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="employee_name"></span></p>
                    <p><strong>Email:</strong> <span id="employee_email"></span></p>
                    <p><strong>Phone:</strong> <span id="employee_phone"></span></p>
                    <p><strong>Address:</strong> <span id="employee_address"></span></p>
                    <p><strong>Department:</strong> <span id="employee_department"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- UPDATE EMPLOYEE MODAL -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <input type="hidden" id="editEmployeeId">
                        <input type="hidden" id="editDepartmentId" value={{ $department->id }}>
                        
                        <div class="mb-3">
                            <label for="editEmployeeName" class="form-label">Name</label>
                            <input type="text" class="form-control shadow-none" id="editEmployeeName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeeEmail" class="form-label">Email</label>
                            <input type="email" class="form-control shadow-none" id="editEmployeeEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeePhone" class="form-label">Phone</label>
                            <input type="text" class="form-control shadow-none" id="editEmployeePhone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeeAddress" class="form-label">Address</label>
                            <input type="text" class="form-control shadow-none" id="editEmployeeAddress" name="address">
                        </div>
                        <div id="editFormMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary fw-medium" id="updateEmployee">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE EMPLOYEE MODAL -->
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEmployeeModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteEmployee">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let $tooltipButton = $('[data-add-employee-tooltip]');

            $tooltipButton.tooltip();

            $('#addEmployeeModal').on('hidden.bs.modal', function () {
                $tooltipButton.tooltip('hide').tooltip('dispose');

                setTimeout(() => {
                    $tooltipButton.tooltip();
                }, 200);
            });

            $('#saveEmployee').click(function (e) {
                e.preventDefault();

                let department_id = $('#employeeDepartmentId').val().trim();
                let name = $('#employeeName').val().trim();
                let email = $('#employeeEmail').val().trim();
                let phone = $('#employeePhone').val().trim();
                let address = $('#employeeAddress').val().trim();
                let $messageBox = $('#formMessage');

                $messageBox.html('');

                if (name === '' || email === '' || phone === '' || address === '') {
                    $messageBox.html('<div class="alert alert-danger">All fields are required!</div>');
                    return;
                }

                $.ajax({
                    url: '{{ route("employee.store") }}',
                    type: 'POST',
                    data: {
                        department_id: department_id,
                        name: name,
                        email: email,
                        phone: phone,
                        address: address,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $messageBox.html('<div class="alert alert-success">Employee added successfully!</div>');

                        $('#employeeName, #employeeEmail, #employeePhone, #employeeAddress').val('');

                        setTimeout(function () {
                            $('#addEmployeeModal').modal('hide');
                            location.reload();
                            $messageBox.html('');
                        }, 1500);
                    },
                    error: function (xhr) {
                        let errorMessage = 'An error occurred!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $messageBox.html('<div class="alert alert-danger">' + errorMessage + '</div>');
                    }
                });
            });

            $('.viewEmployeeBtn').click(function() {
                let employeeName = $(this).data('name');
                let employeeEmail = $(this).data('email');
                let employeePhone = $(this).data('phone');
                let employeeAddress = $(this).data('address');
                let employeeDepartment = $(this).data('department');

                $('#employee_name').text(employeeName);
                $('#employee_email').text(employeeEmail);
                $('#employee_phone').text(employeePhone);
                $('#employee_address').text(employeeAddress);
                $('#employee_department').text(employeeDepartment);
            });

            $('.edit-employee').click(function () {
                let deptId = $(this).data('id'); 

                $.ajax({
                    url: '/employee/' + deptId + '/edit',
                    type: 'GET',
                    success: function (response) {
                        $('#editEmployeeId').val(response.id);
                        $('#editEmployeeName').val(response.name);
                        $('#editEmployeeEmail').val(response.email);
                        $('#editEmployeePhone').val(response.phone);
                        $('#editEmployeeAddress').val(response.address);

                        $('#editEmployeeModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to fetch department details.');
                    }
                });
            });

            $('#updateEmployee').click(function (e) {
                e.preventDefault();

                let employeeId = $('#editEmployeeId').val();
                let departmentId = $('#editDepartmentId').val();
                let name = $('#editEmployeeName').val();
                let email = $('#editEmployeeEmail').val();
                let phone = $('#editEmployeePhone').val();
                let address = $('#editEmployeeAddress').val();

                let $messageBox = $('#editFormMessage');

                $messageBox.html('');

                if (name === '' || email === '' || phone === '' || address === '') {
                    $messageBox.html('<div class="alert alert-danger">All fields are required!</div>');
                    return;
                }

                $.ajax({
                    url: '/employee/' + employeeId, 
                    type: 'PUT',
                    data: {
                        department_id: departmentId,
                        name: name,
                        email: email,
                        phone: phone,
                        address: address,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function (response) {
                        $messageBox.html('<div class="alert alert-success">Employee updated successfully!</div>');

                        let employeeRow = $('#employee-' + employeeId);
                        employeeRow.find('.employee-name').text(name);
                        employeeRow.find('.employee-email').text(email);
                        employeeRow.find('.employee-phone').text(phone);
                        employeeRow.find('.employee-address').text(address);

                        setTimeout(function () {
                            $('#editEmployeeModal').modal('hide');
                            $messageBox.html('');
                        }, 1500);
                    },
                    error: function (xhr) {
                        let errorMessage = 'An error occurred!';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $messageBox.html('<div class="alert alert-danger">' + errorMessage + '</div>');
                    }
                });
            });

            $(document).on('click', '.delete-employee', function (e) {
                e.preventDefault();

                employeeIdToDelete = $(this).data('id');
                $('#deleteEmployeeModal').modal('show');
            });


            $('#confirmDeleteEmployee').click(function () {
                if (!employeeIdToDelete) return;

                $.ajax({
                    url: '/employee/' + employeeIdToDelete, 
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#employee-' + employeeIdToDelete).fadeOut(500, function () {
                            $(this).remove();
                        });

                        $('#deleteEmployeeModal').modal('hide');
                    },
                    error: function (xhr) {
                        alert('Error deleting department. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
