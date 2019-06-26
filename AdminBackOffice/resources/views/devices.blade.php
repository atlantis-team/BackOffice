@extends('layout.app')

@section('content')

    <div class="card">
        <div class="card-body">

            <table class="table border" id="devicesTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>DeviceName</th>
                    <th>Metrics count</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>

            <div class="modal fade" id="userModal" role="dialog" aria-labelledby="userModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <select class="userDropdown form-control" name="userDropdown"></select>
                            <div class="alert alert-danger m-0 mt-3" role="alert" style="display:none;">
                                Error
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="btn-user-modal-apply">Apply changes
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#devicesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('devices.all') !!}',
                columns: [
                    {data: 'ID', name: 'ID'},
                    {data: 'DeviceName', name: 'DeviceName'},
                    {data: 'MetricsCount', name: 'MetricsCount'},
                    {data: 'User_ID', name: 'User_ID'},
                    {data: 'Actions', name: 'Actions'},
                ]
            });
        });

        $('#userModal').on('show.bs.modal', function (e) {
            let deviceId = e.relatedTarget.closest('tr').getAttribute('id');
            let userName = e.relatedTarget.closest('tr').childNodes[3].childNodes[0].innerHTML;
            let userId = e.relatedTarget.closest('tr').childNodes[3].childNodes[0].getAttribute('data-user-id');
            console.log(deviceId, userName, userId);

            $(this).find('#btn-user-modal-apply').attr('device-id', deviceId);

            $('.userDropdown').select2({
                placeholder: 'Select a User',
                multiple: false,
                width: '100%',
                data: [{id: userId, text: userName}],
                ajax: {
                    url: "{{ route('users.ajax') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.FirstName + " " + item.LastName,
                                    id: item.ID
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        $('#btn-user-modal-apply').on('click', function () {
            let userId = $('.userDropdown').select2('data')[0].id;
            let deviceId = $(this).attr('device-id');

            $('#userModal').find('.alert').fadeOut();

            $.ajax({
                url: "{{route('devices.add.user')}}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: userId,
                    device_id: deviceId
                },
                success: function (data) {
                    if (data.success) {
                        $('#userModal').modal('hide');
                        $('tr[id=' + deviceId + '] [data-user-id]').attr('data-user-id', data.data.user_id).text(data.data.user_name);
                        $('#devicesTable tr[id=' + deviceId + '] .btn-remove-user').prop("disabled", false);
                    } else {
                        $('#userModal').find('.alert').text(data.error).fadeIn();
                    }
                }
            });
        });

        $('#devicesTable').on('click', '.btn-remove-user', function () {
            let deviceId = $(this).closest('tr').attr('id');

            console.log($(this));

            $.ajax({
                url: "{{route('devices.remove.user')}}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    device_id: deviceId
                },
                success: function (data) {
                    if (data.success) {
                        $('#userModal').modal('hide');
                        $('tr[id=' + deviceId + '] [data-user-id]').attr('data-user-id', '').text('');
                        $('#devicesTable tr[id=' + deviceId + '] .btn-remove-user').prop("disabled", true);
                    } else {

                    }
                }
            });
        });
    </script>
@endpush
