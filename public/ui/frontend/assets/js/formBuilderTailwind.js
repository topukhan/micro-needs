let fields = [];

// Initialize field type options toggle
$("#field_type").on("change", function () {
    const type = $(this).val();
    $("#options_container").toggleClass("hidden", !["checkbox", "radio", "select"].includes(type));
});

// Add a new field
$("#add_field").on("click", function () {
    const fieldType = $("#field_type").val();
    const fieldName = $("#field_name").val().trim();
    const fieldLabel = $("#field_label").val().trim();
    const fieldOptions = $("#field_options").val().trim();

    if (!validateField(fieldType, fieldName, fieldLabel, fieldOptions)) return;

    const field = {
        type: fieldType,
        name: fieldName,
        label: fieldLabel,
        options: ["checkbox", "radio", "select"].includes(fieldType)
            ? fieldOptions.split(",").map(option => option.trim())
            : [],
    };

    fields.push(field);
    resetInputs();
    updateUI();
});

// Validate field input
function validateField(type, name, label, options) {
    if (!name || !label) {
        alert("Field Name and Label are required.");
        return false;
    }
    if (fields.some(field => field.name === name)) {
        alert("Field Name must be unique.");
        return false;
    }
    if (["checkbox", "radio", "select"].includes(type) && !options) {
        alert("Options are required for checkbox, radio, and select fields.");
        return false;
    }
    if (type === "button" && fields.some(field => field.type === "button")) {
        alert("Only one submit button is allowed.");
        return false;
    }
    return true;
}

// Reset input fields
function resetInputs() {
    $("#field_name, #field_label, #field_options").val("");
    $("#options_container").addClass("hidden");
}

// Update UI: Preview, field list, and generated HTML
function updateUI() {
    updatePreview();
    updateFieldList();
}

// Update the preview form
function updatePreview() {
    const previewForm = $("#preview_form");
    const generatedHtml = $("#generated_html");

    const renderedFields = fields.map(renderField).join("");
    previewForm.html(renderedFields);
    generatedHtml.text(renderedFields.trim());
}

// Render HTML for individual fields
function renderField(field) {
    switch (field.type) {
        case "checkbox":
        case "radio":
            return renderMultipleChoiceField(field);
        case "select":
            return renderSelectField(field);
        case "button":
            return `
<div class="mb-4">
    <button type="submit" name="${field.name}" class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded">
        ${field.label}
    </button>
</div>`;
        case "text":
        case "number":
        case "email":
        case "password":
        case "file":
        case "date":
        default:
            return `
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">${field.label}</label>
    <input type="${field.type}" name="${field.name}" class="w-full border-gray-300 rounded mt-1">
</div>`;
        case "textarea":
            return `
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">${field.label}</label>
    <textarea name="${field.name}" class="w-full border-gray-300 rounded mt-1"></textarea>
</div>`;
    }
}

// Render checkbox and radio fields
function renderMultipleChoiceField(field) {
    const options = field.options
        .map(
            option => `
<div class="mr-4">
    <label class="inline-block text-sm text-gray-700">
        <input type="${field.type}" name="${field.name}" value="${option}" class="mr-2">${option}
    </label>
</div>`
        )
        .join("");

    return `
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">${field.label}</label>
    <div class="flex flex-wrap mt-2">${options}</div>
</div>`;
}

// Render select fields
function renderSelectField(field) {
    const options = field.options
        .map(option => `<option value="${option}">${option}</option>`)
        .join("");

    return `
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">${field.label}</label>
    <select name="${field.name}" class="w-full border-gray-300 rounded mt-1">${options}</select>
</div>`;
}

// Update the field list
function updateFieldList() {
    const fieldList = $("#field_list");
    fieldList.empty();

    fields.forEach((field, index) => {
        fieldList.append(`
<div class="flex justify-between items-center mb-2">
    <span>${field.label} (${field.type})</span>
    <button class="bg-red-500 text-white px-2 py-1 rounded remove-field" data-index="${index}">Remove</button>
</div>`);
    });

    $(".remove-field").off("click").on("click", function () {
        const index = $(this).data("index");
        fields.splice(index, 1);
        updateUI();
    });
}

// Copy generated HTML
$("#copy_html").on("click", function () {
    const htmlContent = $("#generated_html").text();
    navigator.clipboard.writeText(htmlContent).then(() => {
        const copyButton = $(this);
        copyButton.text("Copied");
        setTimeout(() => copyButton.text("Copy HTML"), 3000);
    });
});
