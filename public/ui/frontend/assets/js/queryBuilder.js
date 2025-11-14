// public/ui/frontend/assets/js/queryBuilder.js

class QueryBuilder {
    constructor() {
        this.availableColumns = [];
        this.elements = {};
        this.init();
    }

    init() {
        this.cacheElements();
        this.bindEvents();
    }

    cacheElements() {
        // Cache all DOM elements to avoid null errors
        this.elements = {
            tableSelect: document.getElementById('tableSelect'),
            columnBtn: document.getElementById('columnBtn'),
            columnList: document.getElementById('columnList'),
            columnsContent: document.getElementById('columnsContent'),
            columnsCheckbox: document.getElementById('columnsCheckbox'),
            filtersContainer: document.getElementById('filtersContainer'),
            addFilterBtn: document.getElementById('addFilterBtn'),
            sortBy: document.getElementById('sortBy'),
            sortOrder: document.getElementById('sortOrder'),
            limit: document.getElementById('limit'),
            promptInput: document.getElementById('promptInput'),
            executeBtn: document.getElementById('executeBtn'),
            resetBtn: document.getElementById('resetBtn'),
            loading: document.getElementById('loading'),
            warningAlert: document.getElementById('warningAlert'),
            errorAlert: document.getElementById('errorAlert'),
            successResults: document.getElementById('successResults'),
            resultCount: document.getElementById('resultCount'),
            resultTable: document.getElementById('resultTable'),
            generatedQuery: document.getElementById('generatedQuery')
        };

        // Check if all elements exist
        for (const [key, element] of Object.entries(this.elements)) {
            if (!element) {
                console.error(`Element not found: ${key}`);
            }
        }
    }

    bindEvents() {
        if (this.elements.tableSelect) {
            this.elements.tableSelect.addEventListener('change', () => this.loadColumns());
        }
        
        if (this.elements.addFilterBtn) {
            this.elements.addFilterBtn.addEventListener('click', () => this.addFilter());
        }
        
        if (this.elements.executeBtn) {
            this.elements.executeBtn.addEventListener('click', () => this.executeQuery());
        }
        
        if (this.elements.resetBtn) {
            this.elements.resetBtn.addEventListener('click', () => this.resetForm());
        }

        // Event delegation for dynamic elements
        if (this.elements.filtersContainer) {
            this.elements.filtersContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-filter')) {
                    e.target.closest('.filter-row').remove();
                }
            });
        }
    }

    async loadColumns() {
        if (!this.elements.tableSelect) return;
        
        const table = this.elements.tableSelect.value;
        if (!table) return;

        this.toggleElements(true);
        this.showLoading('Loading columns...');

        try {
            const response = await fetch(`/query-builder/columns/${table}`);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Columns response:', data);

            if (data.error) {
                this.showError(data.error);
            } else if (data.columns && Array.isArray(data.columns)) {
                this.hideLoading();
                this.availableColumns = data.columns;
                this.showColumns(data.columns);
                this.populateColumnOptions(data.columns);
            } else {
                throw new Error('Invalid columns data received');
            }
        } catch (error) {
            console.error('Load columns error:', error);
            this.showError(`Failed to load columns: ${error.message}`);
        }
    }

    showColumns(columns) {
        if (!Array.isArray(columns)) {
            console.error('Columns is not an array:', columns);
            this.showError('Invalid columns data received');
            return;
        }
        
        if (this.elements.columnList && this.elements.columnsContent) {
            this.elements.columnList.classList.remove('hidden');
            this.elements.columnsContent.innerHTML = 
                `<strong>Available Columns (${columns.length}):</strong> ${columns.join(', ')}`;
        }
    }

    populateColumnOptions(columns) {
        this.updateCheckboxes(columns);
        this.updateSelects(columns);
    }

    updateCheckboxes(columns) {
        if (!this.elements.columnsCheckbox) {
            console.error('columnsCheckbox element not found');
            return;
        }

        this.elements.columnsCheckbox.innerHTML = columns.map(column => `
            <div class="flex items-center">
                <input type="checkbox" id="col_${column}" name="columns[]" value="${column}" 
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked>
                <label for="col_${column}" class="ml-2 text-sm text-gray-700">${column}</label>
            </div>
        `).join('');
    }

    updateSelects(columns) {
        const options = columns.map(col => `<option value="${col}">${col}</option>`).join('');
        
        if (this.elements.sortBy) {
            this.elements.sortBy.innerHTML = `<option value="">No sorting</option>${options}`;
        }
        
        // Update existing filter selects
        document.querySelectorAll('.filter-column').forEach(select => {
            select.innerHTML = `<option value="">Select column</option>${options}`;
        });
    }

    addFilter() {
        if (!this.elements.filtersContainer) return;
        
        const template = document.getElementById('filterTemplate');
        if (!template) {
            console.error('Filter template not found');
            return;
        }

        const clone = template.cloneNode(true);
        clone.classList.remove('hidden');
        clone.removeAttribute('id');
        
        // Populate columns in the new filter
        const columnSelect = clone.querySelector('.filter-column');
        if (columnSelect) {
            columnSelect.innerHTML = `<option value="">Select column</option>${
                this.availableColumns.map(col => `<option value="${col}">${col}</option>`).join('')
            }`;
        }
        
        this.elements.filtersContainer.appendChild(clone);
    }

    resetForm() {
        if (this.elements.tableSelect) this.elements.tableSelect.value = '';
        if (this.elements.promptInput) this.elements.promptInput.value = '';
        if (this.elements.sortBy) this.elements.sortBy.value = '';
        if (this.elements.sortOrder) this.elements.sortOrder.value = 'asc';
        if (this.elements.limit) this.elements.limit.value = '';
        if (this.elements.filtersContainer) this.elements.filtersContainer.innerHTML = '';
        if (this.elements.columnList) this.elements.columnList.classList.add('hidden');
        if (this.elements.executeBtn) this.elements.executeBtn.disabled = true;
        if (this.elements.columnsCheckbox) this.elements.columnsCheckbox.innerHTML = '';
        
        this.hideResults();
        this.availableColumns = [];
    }

    async executeQuery() {
        const formData = this.collectFormData();
        
        if (!formData.table) {
            alert('Please select a table');
            return;
        }

        this.showLoading('Generating and executing query...');
        this.hideResults();

        try {
            const response = await fetch('/execute-query', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();
            this.handleResponse(data);
        } catch (error) {
            this.showError('Network error: ' + error.message);
        } finally {
            this.hideLoading();
        }
    }

    collectFormData() {
        const formData = {
            table: this.elements.tableSelect?.value || '',
            prompt: this.elements.promptInput?.value || ''
        };

        // Columns
        const selectedColumns = Array.from(document.querySelectorAll('input[name="columns[]"]:checked'))
            .map(cb => cb.value)
            .filter(Boolean);
            
        if (selectedColumns.length > 0) {
            formData.columns = selectedColumns;
        }

        // Filters
        const filters = Array.from(document.querySelectorAll('.filter-row')).map(row => {
            const column = row.querySelector('.filter-column')?.value;
            const operator = row.querySelector('.filter-operator')?.value;
            const value = row.querySelector('.filter-value')?.value;
            
            return column && value ? { column, operator, value } : null;
        }).filter(Boolean);

        if (filters.length > 0) {
            formData.filters = filters;
        }

        // Sorting & Limit
        const sortBy = this.elements.sortBy?.value;
        if (sortBy) {
            formData.sort_by = sortBy;
            formData.sort_order = this.elements.sortOrder?.value || 'asc';
        }

        const limit = this.elements.limit?.value;
        if (limit) {
            formData.limit = parseInt(limit);
        }

        return formData;
    }

    handleResponse(data) {
        if (data.warning) {
            this.showWarning(data.warning);
            return;
        }
        
        if (data.error) {
            this.showError(data.error);
            return;
        }
        
        this.displayResults(data);
    }

    displayResults(data) {
        if (!data.data || !data.data.length) {
            this.showError('No results found');
            return;
        }

        const headers = Object.keys(data.data[0]);
        const headerHtml = `<tr>${headers.map(h => 
            `<th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">${h}</th>`
        ).join('')}</tr>`;

        const bodyHtml = data.data.map(row => 
            `<tr>${headers.map(h => 
                `<td class="px-6 py-4 whitespace-nowrap text-sm">${this.formatValue(row[h])}</td>`
            ).join('')}</tr>`
        ).join('');

        if (this.elements.resultTable) {
            this.elements.resultTable.querySelector('thead').innerHTML = headerHtml;
            this.elements.resultTable.querySelector('tbody').innerHTML = bodyHtml;
        }

        if (this.elements.resultCount) {
            this.elements.resultCount.textContent = `Found ${data.count} records`;
        }
        
        if (this.elements.generatedQuery && data.query) {
            this.elements.generatedQuery.textContent = `Query: ${data.query}`;
        }

        if (this.elements.successResults) {
            this.elements.successResults.classList.remove('hidden');
        }
    }

    formatValue(value) {
        if (value === null || value === undefined) return '<span class="text-gray-400">null</span>';
        if (typeof value === 'boolean') return value ? 'true' : 'false';
        if (typeof value === 'object') return JSON.stringify(value);
        return value.toString().substring(0, 100);
    }

    toggleElements(enabled) {
        if (this.elements.columnBtn) this.elements.columnBtn.disabled = !enabled;
        if (this.elements.executeBtn) this.elements.executeBtn.disabled = !enabled;
    }

    showLoading(message) {
        if (this.elements.loading) {
            this.elements.loading.classList.remove('hidden');
            this.elements.loading.innerHTML = message ? 
                `<div class="flex items-center justify-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mr-2"></div>${message}</div>` : 
                '';
        }
    }

    hideLoading() {
        if (this.elements.loading) {
            this.elements.loading.classList.add('hidden');
        }
    }

    showError(message) {
        if (this.elements.errorAlert) {
            this.elements.errorAlert.classList.remove('hidden');
            this.elements.errorAlert.querySelector('#errorText').textContent = message;
        }
    }

    showWarning(message) {
        if (this.elements.warningAlert) {
            this.elements.warningAlert.classList.remove('hidden');
            this.elements.warningAlert.querySelector('#warningText').textContent = message;
        }
    }

    hideResults() {
        if (this.elements.warningAlert) this.elements.warningAlert.classList.add('hidden');
        if (this.elements.errorAlert) this.elements.errorAlert.classList.add('hidden');
        if (this.elements.successResults) this.elements.successResults.classList.add('hidden');
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new QueryBuilder();
});