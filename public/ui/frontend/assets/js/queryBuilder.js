// public/ui/frontend/assets/js/queryBuilder.js

document.addEventListener("DOMContentLoaded", function () {
    const tableSelect = document.getElementById("table");
    const aiPromptSection = document.getElementById("ai-prompt-section");
    const manualBuilder = document.getElementById("manual-builder");
    const useAiBtn = document.getElementById("use-ai");
    const useManualBtn = document.getElementById("use-manual");
    const executeBtn = document.getElementById("execute-query");
    const promptInput = document.getElementById("prompt");
    const columnsContainer = document.getElementById("columns-container");
    const filtersContainer = document.getElementById("filters-container");
    const addFilterBtn = document.getElementById("add-filter");
    const sortBySelect = document.getElementById("sort_by");
    const resultsSection = document.getElementById("results-section");
    const resultsHeader = document.getElementById("results-header");
    const resultsBody = document.getElementById("results-body");
    const sqlQueryEl = document.getElementById("sql-query");
    const resultCount = document.getElementById("result-count");
    const loading = document.getElementById("loading");
    const errorAlert = document.getElementById("error-alert");
    const warningAlert = document.getElementById("warning-alert");
    const copyQueryBtn = document.getElementById("copy-query");

    let currentMode = "manual"; // 'ai' or 'manual'
    let columns = [];
    let columnTypes = {};

    // Toggle AI vs Manual
    useAiBtn.addEventListener("click", () => {
        currentMode = "ai";
        aiPromptSection.classList.remove("hidden");
        manualBuilder.classList.add("hidden");
        useAiBtn.classList.remove("bg-gray-200", "text-gray-700");
        useAiBtn.classList.add(
            "bg-gradient-to-r",
            "from-purple-600",
            "to-indigo-600",
            "text-white"
        );
        useManualBtn.classList.remove(
            "bg-gradient-to-r",
            "from-purple-600",
            "to-indigo-600",
            "text-white"
        );
        useManualBtn.classList.add("bg-gray-200", "text-gray-700");
        promptInput.focus();
    });

    useManualBtn.addEventListener("click", () => {
        currentMode = "manual";
        aiPromptSection.classList.add("hidden");
        manualBuilder.classList.remove("hidden");
        useManualBtn.classList.remove("bg-gray-200", "text-gray-700");
        useManualBtn.classList.add(
            "bg-gradient-to-r",
            "from-purple-600",
            "to-indigo-600",
            "text-white"
        );
        useAiBtn.classList.remove(
            "bg-gradient-to-r",
            "from-purple-600",
            "to-indigo-600",
            "text-white"
        );
        useAiBtn.classList.add("bg-gray-200", "text-gray-700");
    });

    // Table change → load columns
    tableSelect.addEventListener("change", async function () {
        const table = this.value;
        if (!table) {
            resetBuilder();
            return;
        }

        try {
            const res = await fetch(`/query-builder/columns/${table}`);
            if (!res.ok)
                throw new Error(
                    (await res.json()).error || "Failed to load columns"
                );
            const data = await res.json();
            columns = data.columns;
            columnTypes = data.column_types;

            populateColumns();
            populateFiltersAndSort();
            executeBtn.disabled = false;
        } catch (err) {
            showError(err.message);
        }
    });

    function populateColumns() {
        columnsContainer.innerHTML = "";
        const allCheckbox = createCheckbox("*", "*", true);
        columnsContainer.appendChild(allCheckbox);

        columns.forEach((col) => {
            const checkbox = createCheckbox(col, col, false);
            columnsContainer.appendChild(checkbox);
        });
    }

    function createCheckbox(value, label, checked = false) {
        const div = document.createElement("div");
        div.className = "flex items-center";
        div.innerHTML = `
            <input type="checkbox" value="${value}" ${
            checked ? "checked" : ""
        } class="column-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded">
            <label class="ml-2 text-sm text-gray-700">${label}</label>
        `;
        return div;
    }

    function populateFiltersAndSort() {
        // Populate column selects
        document.querySelectorAll(".column-select").forEach((select) => {
            populateColumnSelect(select);
        });
        populateColumnSelect(sortBySelect);
    }

    function populateColumnSelect(select) {
        const current = select.value;
        select.innerHTML = '<option value="">-- Column --</option>';
        columns.forEach((col) => {
            const opt = document.createElement("option");
            opt.value = col;
            opt.textContent = col;
            if (col === current) opt.selected = true;
            select.appendChild(opt);
        });
    }

    // Add Filter Row
    addFilterBtn.addEventListener("click", () => {
        const row = document.createElement("div");
        row.className = "filter-row flex gap-2 items-center";
        row.innerHTML = `
            <select class="column-select flex-1 px-3 py-2 border border-gray-300 rounded-md"></select>
            <select class="operator-select w-32 px-3 py-2 border border-gray-300 rounded-md">
                <option value="=">=</option>
                <option value="!=">!=</option>
                <option value=">">></option>
                <option value="<"><</option>
                <option value=">=">>=</option>
                <option value="<="><=</option>
                <option value="LIKE">LIKE</option>
                <option value="NOT LIKE">NOT LIKE</option>
                <option value="IS NULL">IS NULL</option>
                <option value="IS NOT NULL">IS NOT NULL</option>
            </select>
            <input type="text" class="value-input flex-1 px-3 py-2 border border-gray-300 rounded-md" placeholder="Value">
            <button type="button" class="remove-filter text-red-600 hover:text-red-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        `;
        filtersContainer.appendChild(row);
        populateColumnSelect(row.querySelector(".column-select"));

        row.querySelector(".remove-filter").addEventListener("click", () =>
            row.remove()
        );
    });

    // Remove filter
    filtersContainer.addEventListener("click", (e) => {
        if (e.target.closest(".remove-filter")) {
            e.target.closest(".filter-row").remove();
        }
    });

    // Execute Query
    executeBtn.addEventListener("click", async function () {
        hideAlerts();
        loading.classList.remove("hidden");
        resultsSection.classList.add("hidden");

        const table = tableSelect.value;
        const payload = { table };

        if (currentMode === "ai") {
            payload.prompt = promptInput.value.trim();
            if (!payload.prompt) {
                showError("Please enter an AI prompt.");
                loading.classList.add("hidden");
                return;
            }
        } else {
            // Manual mode
            const selectedCols = Array.from(
                document.querySelectorAll(".column-checkbox:checked")
            ).map((cb) => cb.value);
            if (selectedCols.length === 0) {
                showError("Please select at least one column.");
                loading.classList.add("hidden");
                return;
            }
            payload.columns = selectedCols.includes("*") ? null : selectedCols;

            const filters = [];
            document.querySelectorAll(".filter-row").forEach((row) => {
                const col = row.querySelector(".column-select").value;
                const op = row.querySelector(".operator-select").value;
                const valInput = row.querySelector(".value-input");
                let val = valInput ? valInput.value.trim() : "";

                if (col && op) {
                    if (op === "IS NULL" || op === "IS NOT NULL") {
                        // No value needed
                        filters.push({
                            column: col,
                            operator: op,
                            value: null,
                        });
                        // Optionally hide/disable input
                        if (valInput) valInput.disabled = true;
                    } else {
                        if (val === "") return; // skip if value empty
                        filters.push({ column: col, operator: op, value: val });
                        if (valInput) valInput.disabled = false;
                    }
                }
            });
            if (filters.length > 0) payload.filters = filters;

            const sortBy = sortBySelect.value;
            if (sortBy) payload.sort_by = sortBy;
            payload.sort_order = document.getElementById("sort_order").value;

            const limit = document.getElementById("limit").value;
            if (limit) payload.limit = parseInt(limit);
        }

        try {
            const res = await fetch("/execute-query", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json();

            if (!res.ok) {
                if (data.suspicious) {
                    showWarning(data.warning);
                } else {
                    showError(data.error || "Query failed");
                }
                return;
            }

            displayResults(data);
        } catch (err) {
            showError("Network error: " + err.message);
        } finally {
            loading.classList.add("hidden");
        }
    });

    function displayResults(data) {
        resultsSection.classList.remove("hidden");
        resultCount.textContent = data.count;
        sqlQueryEl.textContent = data.query;

        // Table headers
        resultsHeader.innerHTML = "";
        const sample = data.data[0] || {};
        Object.keys(sample).forEach((key) => {
            const th = document.createElement("th");
            th.className =
                "px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider";
            th.textContent = key;
            resultsHeader.appendChild(th);
        });

        // Table body
        resultsBody.innerHTML = "";
        data.data.forEach((row) => {
            const tr = document.createElement("tr");
            Object.values(row).forEach((value) => {
                const td = document.createElement("td");
                td.className =
                    "px-6 py-4 whitespace-nowrap text-sm text-gray-900";
                td.textContent = value === null ? "NULL" : value;
                tr.appendChild(td);
            });
            resultsBody.appendChild(tr);
        });
    }

    copyQueryBtn.addEventListener("click", () => {
        navigator.clipboard.writeText(sqlQueryEl.textContent);
        copyQueryBtn.textContent = "Copied!";
        setTimeout(() => (copyQueryBtn.textContent = "Copy SQL"), 2000);
    });

    function showError(msg) {
        errorAlert.textContent = msg;
        errorAlert.classList.remove("hidden");
    }

    function showWarning(msg) {
        warningAlert.textContent = msg;
        warningAlert.classList.remove("hidden");
    }

    function hideAlerts() {
        errorAlert.classList.add("hidden");
        warningAlert.classList.add("hidden");
    }

    function resetBuilder() {
        columnsContainer.innerHTML = "";
        filtersContainer.innerHTML = `
            <div class="filter-row flex gap-2 items-center">
                <select class="column-select flex-1 px-3 py-2 border border-gray-300 rounded-md"></select>
                <select class="operator-select w-32 px-3 py-2 border border-gray-300 rounded-md">
                    <option value="=">=</option><option value="!=">!=</option>
                    <option value=">">></option><option value="<"><</option>
                    <option value=">=">>=</option><option value="<="><=</option>
                    <option value="LIKE">LIKE</option><option value="NOT LIKE">NOT LIKE</option>
                </select>
                <input type="text" class="value-input flex-1 px-3 py-2 border border-gray-300 rounded-md" placeholder="Value">
                <button type="button" class="remove-filter text-red-600 hover:text-red-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        `;
        sortBySelect.innerHTML = '<option value="">-- None --</option>';
        executeBtn.disabled = true;
        resultsSection.classList.add("hidden");
        hideAlerts();
    }

    filtersContainer.addEventListener("change", (e) => {
        if (e.target.classList.contains("operator-select")) {
            const row = e.target.closest(".filter-row");
            const valueInput = row.querySelector(".value-input");
            const op = e.target.value;
            if (op === "IS NULL" || op === "IS NOT NULL") {
                valueInput.disabled = true;
                valueInput.value = "";
                valueInput.placeholder = "No value needed";
            } else {
                valueInput.disabled = false;
                valueInput.placeholder = "Value";
            }
        }
    });

    // ADD THIS LINE BELOW — triggers change event on all existing operator selects
    document
        .querySelectorAll(".operator-select")
        .forEach((sel) => sel.dispatchEvent(new Event("change")));
    // Initialize
    useManualBtn.click(); // default to manual
});
