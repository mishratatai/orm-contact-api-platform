<x-app-layout>
    <div class="py-12 pt-20">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-50 dark:bg-gray-800 overflow-hidden sm:rounded-lg"
                style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-end flex items-end justify-end gap-3">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-stone-50 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-stone-50 focus:bg-gray-700 dark:focus:bg-stone-50 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Generate Api Token
                    </button>
                </div>
                <div class="px-6 pb-6">
                    <h2 class="mb-3 text-xl text-gray-900 dark:text-gray-100">All API Listings</h2>
                    <div class="flex justify-between">
                        <div class="w-[70%] border-t-[1px] border-slate-500">
                            @if (count($all_token) == 0)
                                <p class="text-gray-900 dark:text-gray-100 text-sm py-3 m-0">
                                    {{ "It looks like you don't have any API tokens. Create your first one now!" }}
                                </p>
                            @endif
                            @foreach ($all_token as $token)
                                <div class="flex py-3 items-center justify-between border-b-[1px] border-slate-500">
                                    <div class="w-[40%]">
                                        <p class="text-gray-900 dark:text-gray-100 text-sm p-0 m-0">
                                            {{ $token['name'] }}
                                        </p>
                                    </div>
                                    <div class="w-[25%]">
                                        <span class="py-1 px-2 bg-green-100 text-green-500 rounded-md text-sm">
                                            Active
                                        </span>
                                    </div>
                                    <div class="w-[25%]">
                                        <p class="text-gray-900 dark:text-gray-100 text-sm p-0 m-0">
                                            {{ \Carbon\Carbon::parse($token['created_at'])->format('d-m-y H:i:s A') }}
                                        </p>
                                    </div>
                                    <div class="w-[10%]">
                                        <button type="button" onclick="deleteApi({{ $token['id'] }})"
                                            data-bs-toggle="modal" data-bs-target="#revokeApiKey">
                                            <i class="bi bi-trash3 text-red-500"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                            <div class="bg-red-50 p-3 mb-3 rounded-md flex items-top justify-between mt-3">
                                <div class="w-[35px]">
                                    <i class="bi bi-exclamation-triangle text-red-500 text-2xl"></i>
                                </div>
                                <div class="w-[calc(100%-35px)]">
                                    <p class="m-0 p-0 text-lg font-semibold uppercase text-red-500">
                                        ORM API Reminder
                                    </p>
                                    <ul class="ps-[1rem] m-0">
                                        <li class="list-disc text-sm mb-[3px]">
                                            No contact or captcha plugin is needed.
                                        </li>
                                        <li class="list-disc text-sm mb-[3px]">
                                            The API integration guide is available in the tab below.
                                        </li>
                                        <li class="list-disc text-sm">
                                            We do not access or monitor your application's internal data. Feel free to
                                            work with us.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <ul class="nav nav-tabs p-[5px] rounded-md border-0 inline-flex items-center gap-[5px]
                                bg-[#f4f4f5] dark:bg-slate-900 mb-3"
                                    id="myTab" role="tablist" style="display: inline-flex; padding-left: 5px;">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active py-[3px] px-[15px] rounded-md border-0"
                                            id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                                            type="button" role="tab" aria-controls="home-tab-pane"
                                            aria-selected="true" style="padding: 5px 15px; border: 0; font-size: 13px;">
                                            PHP-cURL
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-md" id="php-gmail-cap-tab" data-bs-toggle="tab"
                                            data-bs-target="#php-gmail-cap-tab-pane" type="button" role="tab"
                                            aria-controls="php-gmail-cap-tab-pane" aria-selected="false"
                                            style="padding: 5px 15px; border: 0; font-size: 13px;">
                                            Google reCaptcha with PHP-cURL
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                        aria-labelledby="home-tab" tabindex="0">
                                        <div class="bg-[#f4f4f5] p-2 rounded-md">
                                            <div>
<p class="m-0 p-0 mb-2">How to send Contact form data to ORM Platform</p>
<span class="py-1 px-2 bg-red-100 text-red-500 rounded-md text-sm mb-[5px] inline-block">
    Method Post
</span>
<pre class="m-0"><code class="hljs p-3 rounded-md" id="p_code_code" style="font-size: 14px;">if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        !empty($_POST['contact_data_name']) &&
        !empty($_POST['contact_data_email']) &&
        !empty($_POST['contact_data_phone_no']) &&
        !empty($_POST['contact_data_desc'])
    ) {
        $name      = $_POST['contact_data_name'];
        $email     = $_POST['contact_data_email'];
        $phone     = $_POST['contact_data_phone_no'];
        $desc      = $_POST['contact_data_desc'];
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        $curl = curl_init();
            $postData = [
                "email"                   => "info@abc.com", /* Authorized email */
                "contact_data_source"     => "Application Name",
                "contact_data_name"       => $_POST['contact_data_name'],
                "contact_data_email"      => $_POST['contact_data_email'],
                "contact_data_phone_no"   => $_POST['contact_data_phone_no'],
                "contact_data_desc"       => $_POST['contact_data_desc'],
                "ip_address"              => $ipAddress,
            ];
            $jsonData = json_encode($postData);
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.ormrooms.com/api/contacts/store-new-contact',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $jsonData,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer 1|apESKjfEEZzU0cPJ3FhxXWDNaV9ltV1yC6qFiLlebf21dc25'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            echo $response;
    }
}
</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="php-gmail-cap-tab-pane" role="tabpanel"
                                        aria-labelledby="php-gmail-cap-tab" tabindex="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-[28%]">
                            <div class="bg-red-50 p-3 rounded-md">
                                <p class="m-0 p-0 text-red-500 mb-2 text-lg font-semibold uppercase">
                                    API Key Security Guidelines 🔑
                                </p>
                                <ul class="ps-[1rem] m-0">
                                    <li class="list-disc text-sm mb-2">
                                        Each user can create up to 3 API keys.
                                    </li>
                                    <li class="list-disc text-sm mb-2">
                                        Regularly rotate your API keys to minimize potential risks. Consider setting
                                        reminders to revoke and regenerate keys periodically.
                                    </li>
                                    <li class="list-disc text-sm mb-2">
                                        Never commit API keys to version control systems (like Git). Use environment
                                        variables or secure configuration management tools instead.
                                    </li>
                                    <li class="list-disc text-sm mb-2">
                                        Avoid storing API keys in client-side code (JavaScript, mobile apps). This
                                        exposes them to potential security breaches.
                                    </li>
                                    <li class="list-disc text-sm mb-2">
                                        If you suspect an API key has been compromised, immediately revoke it and
                                        generate a new one.
                                    </li>
                                    <li class="list-disc text-sm">
                                        For security reasons, the API key is displayed only once. Please save it
                                        carefully.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Generate Api Token</h5>
                <button type="button" class="btn-close shadow-none focus:shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="apikeynameForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="apikeyname"
                                class="block font-medium text-sm text-gray-700 dark:text-gray-700 mb-2">Enter API
                                Name</label>
                            <input type="text"
                                class="bg-stone-50 dark:bg-stone-50 border-gray-300 dark:border-gray-300  dark:text-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm form-control"
                                id="apikeyname" name="apikeyname">
                            <span class="error-message"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-stone-50 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-stone-50 focus:bg-gray-700 dark:focus:bg-stone-50 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-stone-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">Generate Api Token</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="apiTokenCopyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Copy Api Key</h5>
                <button type="button" class="btn-close shadow-none focus:shadow-none" data-bs-dismiss="modal"
                    aria-label="Close" onclick="loadApi()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="bg-red-100 p-2 px-3 border-[1px] border-red-500 rounded-md">
                            <p class="text-red-500 m-0">For security reasons, this API key will only be shown once.
                                <br>
                                Copy and store it securely.
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="apikeyname"
                            class="block font-medium text-sm text-gray-700 dark:text-gray-700 mb-2">Copy API
                            Key</label>
                        <input type="text"
                            class="bg-stone-50 dark:bg-stone-50 border-gray-300 dark:border-gray-300 dark:text-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm form-control"
                            id="copyApiKey" name="copyApiKey">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-stone-50 dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-stone-50 focus:bg-gray-700 dark:focus:bg-stone-50 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                    data-bs-dismiss="modal" onclick="loadApi()">Close Modal</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="revokeApiKey" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="staticBackdropLabel">Delete Api Token</h5>
                <button type="button" class="btn-close shadow-none focus:shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form id="revokeAPITokenForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <input type="hidden" id="revokeAPITokenid" name="revokeAPITokenid">
                        <div class="col-12">
                            <div class="bg-red-100 p-2 px-3 border-[1px] border-red-500 rounded-md">
                                <p
                                    class="text-xl text-red-500 m-0 flex flex-col justify-center items-center text-center">
                                    <i class="bi bi-exclamation-triangle text-3xl"></i>
                                    Are you sure you <br> want to delete this Api Key?
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
                        Delete Api Token
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#apikeynameForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('generateApiKey') }}",
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        $('#staticBackdrop').modal('hide');
                        $('#copyApiKey').val(response.token);
                        $('#apiTokenCopyModal').modal('show');
                    }
                },
                error: function(response) {
                    console.log(response);
                    handleApiError(response);
                }
            });
        });
    });

    function handleApiError(response) {
        console.log(response); // Log the full response for debugging

        // Clear previous errors
        $('.error-message').remove();

        if (response && response.responseJSON && response.responseJSON.errors) {
            const errors = response.responseJSON.errors;

            // Iterate through the errors object
            for (const field in errors) {
                if (errors.hasOwnProperty(field)) {
                    const errorMessages = errors[field];

                    // Append error messages to the corresponding input field
                    const inputField = $('#' + field);
                    if (inputField.length) { // Check if the input field exists
                        errorMessages.forEach(message => {
                            inputField.after('<div class="error-message text-red-500 text-sm mt-1">' + message +
                                '</div>');
                        });
                    } else {
                        //If the input field does not exist, append the messages to the top of the modal or form.
                        $('.row.g-3').prepend('<div class="error-message text-red-500 text-sm mt-1">' + errorMessages +
                            '</div>');
                    }
                }
            }
        } else if (response && response.responseJSON && response.responseJSON.message) {
            // Handle general error messages (e.g., server errors)
            $('.row.g-3').prepend('<div class="error-message text-red-500 text-sm mt-1">' + response.responseJSON
                .message + '</div>');
        } else {
            // Handle unexpected errors
            $('.row.g-3').prepend(
                '<div class="error-message text-red-500 text-sm mt-1">An unexpected error occurred.</div>');
        }
    }

    function loadApi() {
        setTimeout(() => {
            window.location.reload()
        }, 1500);
    }

    function deleteApi(id) {
        $('#revokeAPITokenid').val(id);
    }

    $(document).ready(function() {
        $('#revokeAPITokenForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('revokeApiToken') }}",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status == 'success') {
                        $('#revokeApiKey').modal('hide');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

    hljs.highlightAll();
</script>
