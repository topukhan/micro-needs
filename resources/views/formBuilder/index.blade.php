<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .shadow-glow-blue {
            box-shadow: 0 .5rem 1.5rem rgba(117, 166, 222, 0.5); /* Blue glow */
        }
    
        .shadow-glow-red {
            box-shadow: 0 .5rem 1.5rem rgba(238, 94, 94, 0.5); /* Red glow */
        }
    
        .shadow-glow-green {
            box-shadow: 0 .5rem 1.5rem rgba(65, 195, 100, 0.175); /* Green glow */
            
        }
        @media (max-width: 768px) { /* Adjust width breakpoint if needed */
    .table-responsive-md {
        overflow-x: auto; /* Ensures horizontal scroll on overflow */
        white-space: nowrap; /* Prevents table contents from wrapping */
    }
}

.animated-gradient {
    background: linear-gradient(90deg, #0e1c23, #1b3a3a, #345b58, #4c7d75, #629b91);
    background-size: 300% 300%;
    animation: gradientAnimation 6s ease-in-out infinite;
    color: white;
    padding: 15px;
}

@keyframes gradientAnimation {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

    </style>
</head>
<body>
    <h2 class="text-center py-3 text-white animated-gradient" style="font-family: monospace;">
        Form Builder (Bootstrap)
        <a href="{{ route('dashboard') }}" class="fs-5 btn btn-outline-info">Home</a>
    </h2>
    <div class="container-fluid my-4">
        <div class="row">
            <!-- Left Section -->
            <div class="col-md-2 offset-md-1 mt-2">
                <!-- can i add glow effect in bootstrap for shadow with different color -->
                <div class="card border-0 p-3 shadow-glow-green">
                    <h5 class="mb-3">Field Selection</h5>
                    <form id="fieldSelectionForm">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="text" id="fieldText">
                            <label class="form-check-label" for="fieldText">Text</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="number" id="fieldNumber">
                            <label class="form-check-label" for="fieldNumber">Number</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="email" id="fieldEmail">
                            <label class="form-check-label" for="fieldEmail">Email</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="password" id="fieldPassword">
                            <label class="form-check-label" for="fieldPassword">Password</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="textarea" id="fieldTextarea">
                            <label class="form-check-label" for="fieldTextarea">Textarea</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="checkbox" id="fieldCheckbox">
                            <label class="form-check-label" for="fieldCheckbox">Checkbox</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="radio" id="fieldRadio">
                            <label class="form-check-label" for="fieldRadio">Radio</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="select" id="fieldSelect">
                            <label class="form-check-label" for="fieldSelect">Select</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="date" id="fieldDate">
                            <label class="form-check-label" for="fieldDate">Date</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="file" id="fieldFile">
                            <label class="form-check-label" for="fieldFile">File</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="button" id="fieldButton">
                            <label class="form-check-label" for="fieldButton">Button</label>
                        </div>
                    </form>
                </div>
            </div>
    
            <!-- Right Section -->
            <div class="col-md-8 mt-2">
                <div class="card border-0 p-3 shadow-glow-blue">
                    <h5 class="mb-3">Field Options</h5>
                    <div class="table-responsive-md">
                        <table id="fieldOptionsTable" class="table">
                            <thead>
                                <tr>
                                    <th>Select Field Type</th>
                                    <th>Enter Field Name</th>
                                    <th>Enter Field Label</th>
                                    <th>Enter Placeholder/Options</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="btn-section mt-2">
                        <button id="showPreview" class="btn btn-success">Show Preview</button>
                        <button id="addField" class="btn btn-dark">Add Field</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    
    <!-- Modal for preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Form Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form preview content will go here -->
            </div>
            <div class="modal-footer">
                <!-- Copy HTML button -->
                <pre id="generated_html" class="bg-light p-3 rounded border overflow-auto d-none">No Field Selected</pre>
                <button type="button" class="btn btn-success" id="copyHtml">Copy HTML</button>
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('ui/frontend/assets/js/formBuilder.js') }}"></script>
</body>
</html>
