@extends('layouts.app')

@section('page_title', 'Attendance Monitoring')
@section('page_subtitle', 'Live view of scanned student QR codes')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Attendance Monitoring (Editable)</h5>

            <table class="table table-striped" id="attendanceTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Barcode / Student ID</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Attendance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="attendance_id" id="attendance_id">
                        <div class="mb-3">
                            <label for="edit_barcode" class="form-label">Barcode</label>
                            <input type="text" class="form-control" id="edit_barcode" name="barcode" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const tableBody = document.querySelector("#attendanceTable tbody");
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            const editForm = document.getElementById('editForm');

            let attendances = [];

            function fetchAttendance() {
                fetch("{{ route('attendance.monitoring.data') }}")
                    .then(res => res.json())
                    .then(data => {
                        attendances = data;
                        tableBody.innerHTML = "";
                        data.forEach((item, index) => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${item.barcode}</td>
                        <td>${new Date(item.created_at).toLocaleString()}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-id="${item.id}" data-barcode="${item.barcode}">Edit</button>
                        </td>
                    `;
                            tableBody.appendChild(row);
                        });

                        document.querySelectorAll(".edit-btn").forEach(btn => {
                            btn.addEventListener("click", function() {
                                const id = this.dataset.id;
                                const barcode = this.dataset.barcode;
                                document.getElementById('attendance_id').value = id;
                                document.getElementById('edit_barcode').value = barcode;
                                editModal.show();
                            });
                        });
                    });
            }

            fetchAttendance();
            setInterval(fetchAttendance, 5000); 

            editForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const id = document.getElementById('attendance_id').value;
                const barcode = document.getElementById('edit_barcode').value;

                fetch(`/attendance/${id}/update`, {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify({
                            barcode: barcode
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            editModal.hide();
                            fetchAttendance();
                            alert(res.message);
                        }
                    })
                    .catch(err => console.error(err));
            });

        });
    </script>
@endsection
