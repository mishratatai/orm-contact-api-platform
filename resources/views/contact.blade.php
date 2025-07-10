<x-app-layout>
    <style>
        .max-width-css {
            display: inline-block;
            width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .modal {
            z-index: 99999;
        }
    </style>
    <div class="py-12 pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-stone-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="data-table-wrap table-wrap">
                        <table id="manageContacts">
                            <thead>
                                <tr>
                                    <th style="min-width: 180px;">Data Source</th>
                                    <th style="min-width: 100px;">Stage</th>
                                    <th style="min-width: 100px;">Status</th>
                                    <th style="min-width: 200px;">Name</th>
                                    <th style="min-width: 200px;">Email</th>
                                    <th style="min-width: 150px;">Phone</th>
                                    <th style="min-width: 200px;">Description</th>
                                    <th style="min-width: 200px;">Ip Address</th>
                                    <th style="min-width: 200px;">Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- Modal area start --}}
<div class="modal fade" id="deleteContactModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Delete Contact Data</h5>
                <button type="button" class="btn-close shadow-none focus:shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="deleteContactModalForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="deleteContact" name="deleteContact">
                        <div class="col-12">
                            <div class="bg-red-100 p-2 px-3 border-[1px] border-red-500 rounded-md">
                                <p
                                    class="text-xl text-red-500 m-0 flex flex-col justify-center items-center text-center">
                                    <i class="bi bi-exclamation-triangle text-3xl"></i>
                                    Are you sure you <br> want to delete this Contact Data?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-stone-50 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-stone-50 focus:bg-gray-700 dark:focus:bg-stone-50 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-indigo-500 transition ease-in-out duration-150"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-stone-50 uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-red-500 transition ease-in-out duration-150"
                        id="revoke-api-key-button">
                        Delete Contact Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="previewContactModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Preview Details</h5>
                <button type="button" class="btn-close shadow-none focus:shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3" id="preview-row">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-stone-50 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-stone-50 focus:bg-gray-700 dark:focus:bg-stone-50 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-indigo-500 transition ease-in-out duration-150"
                    data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
{{-- Modal area end --}}
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
<script>
    $(document).ready(function() {
        $('#manageContacts').DataTable({
            processing: true,
            "order": [
                [0, "desc"]
            ],
            serverSide: true,
            scrollX: true,
            ajax: "{{ route('fetchContacts') }}",
            columns: [{
                    data: 'data_source',
                    name: 'data_source',
                    render: function(data) {
                        return `<span class="py-1 px-2 bg-red-100 text-red-500 rounded-md text-sm mb-[5px] inline-block">${data}</span>`;
                    }
                },
                {
                    data: 'stage',
                    name: 'stage',
                    render: function(data, type, row) {
                        let color = '';
                        switch (data) {
                            case 'New':
                                color = 'green';
                                break;
                            case 'Old':
                                color = 'red';
                                break;
                            default:
                                break;
                        }
                        return `<a href="javascript:void(0)" class="py-1 px-2 bg-${color}-100 text-${color}-500 rounded-md text-sm mb-[5px] inline-block" onclick="updateStage(${row.id})">
                            ${data}
                        </a>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        let color = '';
                        switch (data) {
                            case 'Active':
                                color = 'green';
                                break;
                            case 'Inactive':
                                color = 'red';
                                break;
                            default:
                                break;
                        }
                        return `<a href="javascript:void(0)" class="py-1 px-2 bg-${color}-100 text-${color}-500 rounded-md text-sm mb-[5px] inline-block" onclick="updateStatus(${row.id})">
                            ${data}
                        </a>`;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone_no',
                    name: 'phone_no'
                },
                {
                    data: 'desc',
                    name: 'desc',
                    createdCell: function (td, cellData, rowData, row, col) {
                        $(td).html(`<a href="javascript:void(0)" class="text-gray-900 dark:text-gray-100 underline max-width-css" data-bs-toggle="tooltip" data-bs-title="${cellData}">${cellData}</a>`);
                        $(td).find('[data-bs-toggle="tooltip"]').tooltip();
                    }
                },
                {
                    data: 'ip_address',
                    name: 'ip_address'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    render: function(data) {
                        return `<span class="py-1 px-2 bg-red-100 text-red-500 rounded-md text-sm mb-[5px] inline-block">${moment(data).format('YYYY-MM-DD h:mm:ss a')}</span>`;
                    }
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        return `<button type="button" onclick="previewContactData(${data})">
                        <i class="bi bi-eye text-red-500"></i>
                    </button>
                    <button type="button" onclick="deleteContactData(${data})">
                        <i class="bi bi-trash3 text-red-500"></i>
                    </button>`;
                    }
                },
            ]
        });
    });

    function updateStatus(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('updateContactStatus', ['id' => ':id']) }}".replace(':id', id),
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response.data);
                if (response.status == "success") {
                    var badge = $(`a[onclick="updateStatus(${id})"]`);
                    if (response.data.status == 'Inactive') {
                        badge.removeClass("bg-green-100 text-green-500").addClass("bg-red-100 text-red-500")
                            .text("Inactive");
                    } else if (response.data.status == 'Active') {
                        badge.removeClass("bg-red-100 text-red-500").addClass("bg-green-100 text-green-500")
                            .text("Active");
                    }
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function updateStage(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('updateStage', ['id' => ':id']) }}".replace(':id', id),
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                console.log(response.data);
                if (response.status == "success") {
                    var badge = $(`a[onclick="updateStage(${id})"]`);
                    if (response.data.stage == 'Old') {
                        badge.removeClass("bg-green-100 text-green-500").addClass("bg-red-100 text-red-500")
                            .text("Old");
                    } else if (response.data.stage == 'New') {
                        badge.removeClass("bg-red-100 text-red-500").addClass("bg-green-100 text-green-500")
                            .text("New");
                    }
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function previewContactData(id) {  
        console.log(id);
        $.ajax({
            type: "GET",
            url: "{{ route('previewContact', ['id' => ':id']) }}".replace(':id', id),
            success: function (response) {
                console.log(response);
                if (response.status == "success") {
                    $('#preview-row').empty();
                    $.each(response.data, function(index, value) {
                        $('#preview-row').append(`<div class="col-12">${value}</div>`);
                    });
                    $('#previewContactModal').modal('show');
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    function deleteContactData(id) {
        $('#deleteContact').val(id);
        $('#deleteContactModal').modal('show');
    }

    $(document).ready(function() {
        $('#deleteContactModalForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('deleteContact') }}",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('#deleteContactModal').modal('hide');
                        setTimeout(() => {
                            $('#manageContacts').DataTable().ajax.reload();
                        }, 1000);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
