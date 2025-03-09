@extends('layouts.app')

@section('content')
    
    <x-navbar />
    <div class="container d-flex justify-content-center">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="card data-card shadow-sm w-75 p-3">
                    <div class="card-title">
                        <h1 class="text-center my-2">Departments</h1>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary me-3" 
                                data-add-dept-tooltip="tooltip" 
                                title="Add Department" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addDeptModal">
                                    <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @if ($departments->isNotEmpty())
                                @foreach ($departments AS $department)
                                    <div class="col-md-12" id="department-{{ $department->id }}"> 
                                        <div class="card department-card position-relative">
                                            <a href="{{ route('department.show', $department->id) }}" class="text-decoration-none text-dark">
                                                <div class="card-body dept-name">
                                                    {{ $department->name }}
                                                </div>
                                            </a>
                                    
                                            <div class="dropdown position-absolute top-0 end-0 m-2">
                                                <button class="btn shadow-none border-0 p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('department.show', $department->id) }}">👁 View</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item edit-department" href="#" data-id="{{ $department->id }}">✏ Update</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item delete-department" href="#" data-id="{{ $department->id }}">🗑 Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-end mt-3" id="pagination">
                                    {{ $departments->links('pagination::bootstrap-5') }}
                                </div>
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-info">No departments found!</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--- ADD DEPARTMENT MODAL --->
    <div class="modal fade" id="addDeptModal" tabindex="-1" aria-labelledby="addDeptModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDeptModalLabel">New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addDepartmentForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control shadow-none" id="departmentName" name="name" placeholder="Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control shadow-none" id="departmentDescription" name="description" rows="3" placeholder="Enter your description here..."></textarea>
                        </div>
                        <div id="formMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary fw-medium" id="saveDepartment">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!--- UPDATE DEPARTMENT MODAL --->
    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editDepartmentForm">
                        <input type="hidden" id="editDepartmentId">
                        
                        <div class="mb-3">
                            <label for="editDepartmentName" class="form-label">Department Name</label>
                            <input type="text" class="form-control shadow-none" id="editDepartmentName" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="editDepartmentDescription" class="form-label">Description</label>
                            <textarea class="form-control shadow-none" id="editDepartmentDescription" name="description"></textarea>
                        </div>
                        <div id="editFormMessage"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-medium" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary fw-medium" id="updateDepartment">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!--- DELETE DEPARTMENT MODAL --->
    <div class="modal fade" id="deleteDepartmentModal" tabindex="-1" aria-labelledby="deleteDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteDepartmentModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this department?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteDepartment">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            let $tooltipButton = $('[data-add-dept-tooltip]');

            $tooltipButton.tooltip();

            $('#addDeptModal').on('hidden.bs.modal', function () {
                $tooltipButton.tooltip('hide').tooltip('dispose');

                setTimeout(() => {
                    $tooltipButton.tooltip();
                }, 200);
            });

            $('#saveDepartment').click(function (e) {
                e.preventDefault();

                let name = $('#departmentName').val().trim();
                let description = $('#departmentDescription').val().trim();
                let $messageBox = $('#formMessage');

                $messageBox.html('');

                if (name === '' || description === '') {
                    $messageBox.html('<div class="alert alert-danger">All fields are required!</div>');
                    return;
                }

                $.ajax({
                    url: '{{ route("department.store") }}',
                    type: 'POST',
                    data: {
                        name: name,
                        description: description,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $messageBox.html('<div class="alert alert-success">Department added successfully!</div>');

                        $('#departmentName, #departmentDescription').val('');

                        setTimeout(function () {
                            $('#addDeptModal').modal('hide');
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

            $('.edit-department').click(function () {
                let deptId = $(this).data('id'); 

                $.ajax({
                    url: '/department/' + deptId + '/edit',
                    type: 'GET',
                    success: function (response) {
                        $('#editDepartmentId').val(response.id);
                        $('#editDepartmentName').val(response.name);
                        $('#editDepartmentDescription').val(response.description);

                        $('#editDepartmentModal').modal('show');
                    },
                    error: function () {
                        alert('Failed to fetch department details.');
                    }
                });
            });

            $('#updateDepartment').click(function (e) {
                e.preventDefault();

                let deptId = $('#editDepartmentId').val();
                let name = $('#editDepartmentName').val().trim();
                let description = $('#editDepartmentDescription').val().trim();
                let $messageBox = $('#editFormMessage');

                $messageBox.html('');

                if (name === '' || description === '') {
                    $messageBox.html('<div class="alert alert-danger">All fields are required!</div>');
                    return;
                }

                $.ajax({
                    url: '/department/' + deptId, 
                    type: 'PUT',
                    data: {
                        name: name,
                        description: description,
                        _token: '{{ csrf_token() }}' 
                    },
                    success: function (response) {
                        $messageBox.html('<div class="alert alert-success">Department updated successfully!</div>');

                        let deptRow = $('#department-' + deptId);
                        deptRow.find('.dept-name').text(name);
                        deptRow.find('.dept-description').text(description);

                        setTimeout(function () {
                            $('#editDepartmentModal').modal('hide');
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

            let deptIdToDelete = null;

            $(document).on('click', '.delete-department', function (e) {
                e.preventDefault();

                deptIdToDelete = $(this).data('id');
                $('#deleteDepartmentModal').modal('show');
            });

            $('#confirmDeleteDepartment').click(function () {
                if (!deptIdToDelete) return;

                $.ajax({
                    url: '/department/' + deptIdToDelete, 
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('#department-' + deptIdToDelete).fadeOut(500, function () {
                            $(this).remove();
                        });

                        $('#deleteDepartmentModal').modal('hide');
                        let updatedPagination = $(data).find("#pagination").html();
                        $("#pagination").html(updatedPagination);
                    },
                    error: function (xhr) {
                        alert('Error deleting department. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
