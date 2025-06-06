/**
 * Simple AJAX form handler using existing toast function
 * @param {Object} options - Configuration object
 * @param {string} options.url - Form submission URL
 * @param {FormData} options.data - Form data to submit
 * @param {HTMLElement} options.button - Submit button element
 * @param {Function} options.onSuccess - Success callback function
 */
async function ajaxCall(options) {
    const { url, data, button, onSuccess } = options;

    // Store original button state
    const originalText = button.innerHTML;
    
    try {
        // Show loading state
        button.disabled = true;
        button.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;

        // Clear previous errors
        clearErrors();

        const response = await fetch(url, {
            method: 'POST',
            body: data,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        });

        // Check if response is JSON
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            throw new Error('Server returned HTML instead of JSON. Check your controller response.');
        }

        const result = await response.json();

        if (response.ok) {
            // Success
            if (result.message) {
                toast(result.message, 'success');
            }
            if (onSuccess) {
                onSuccess(result);
            }
            if(result.redirect){
                window.location.href = result.redirect;
            }
        } else {
            // Handle validation errors
            if (response.status === 422 && result.errors) {
                showErrors(result.errors);
                toast('Please fix the validation errors', 'error');
            } else {
                toast(result.message || 'Something went wrong!', 'error');
            }
        }

    } catch (error) {
        console.error('Ajax Error:', error);
        toast('Network error. Please try again.', 'error');
    } finally {
        // Restore button
        button.disabled = false;
        button.innerHTML = originalText;
    }
}

// Show validation errors
function showErrors(errors) {
    Object.keys(errors).forEach(field => {
        const input = document.querySelector(`[name="${field}"]`);
        if (input) {
            input.classList.add('border-red-500');
            
            // Add error message
            let errorDiv = input.parentNode.querySelector('.error-text');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.className = 'error-text text-red-500 text-sm mt-1';
                input.parentNode.appendChild(errorDiv);
            }
            errorDiv.textContent = errors[field][0];
        }
    });
}

// Clear validation errors
function clearErrors() {
    document.querySelectorAll('.border-red-500').forEach(input => {
        input.classList.remove('border-red-500');
    });
    document.querySelectorAll('.error-text').forEach(error => {
        error.remove();
    });
}