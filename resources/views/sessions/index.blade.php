@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h4 class="mb-0">Academic Sessions Management</h4>
                    <a href="{{ route('sessions.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus me-1"></i> New Session
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="sessionsTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Session Name</th>
                                    <th width="15%">Status</th>
                                    <th width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $index => $session)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $session->name }}</td>
                                    <td>
                                        @if($session->is_active)
                                            <span class="badge bg-success rounded-pill">
                                                <i class="fas fa-check-circle me-1"></i> Active
                                            </span>
                                        @else
                                            <form action="{{ route('sessions.activate', $session->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-toggle-off me-1"></i> Activate
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-outline-warning edit-session" 
                                            data-id="{{ $session->id }}" 
                                            data-name="{{ $session->name }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editSessionModal">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Delete Form -->
                                        <form action="{{ route('sessions.destroy', $session->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card-body -->
            </div> <!-- /.card -->
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSessionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">Edit Academic Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editSessionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Session Name</label>
                        <input type="text" class="form-control" id="editSessionName" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Update Session</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#sessionsTable').DataTable({
            responsive: true,
            columnDefs: [{ orderable: false, targets: [3] }]
        });

        $('.edit-session').click(function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $('#editSessionName').val(name);
            $('#editSessionForm').attr('action', `/sessions/${id}`);
        });
    });
</script>
@endpush
