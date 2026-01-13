// Client-side form validation

// Login form validation
function validateLoginForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    let isValid = true;
    let errorMessage = '';

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        errorMessage = 'Email is required.';
        isValid = false;
    } else if (!emailRegex.test(email)) {
        errorMessage = 'Please enter a valid email address.';
        isValid = false;
    }

    // Password validation
    if (!password) {
        errorMessage = 'Password is required.';
        isValid = false;
    }

    if (!isValid) {
        alert(errorMessage);
    }

    return isValid;
}

// Register form validation
function validateRegisterForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    let isValid = true;
    let errorMessage = '';

    // Name validation
    if (!name) {
        errorMessage = 'Name is required.';
        isValid = false;
    } else if (name.length < 2) {
        errorMessage = 'Name must be at least 2 characters long.';
        isValid = false;
    }

    // Email validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        errorMessage = 'Email is required.';
        isValid = false;
    } else if (!emailRegex.test(email)) {
        errorMessage = 'Please enter a valid email address.';
        isValid = false;
    }

    // Password validation
    if (!password) {
        errorMessage = 'Password is required.';
        isValid = false;
    } else if (password.length < 6) {
        errorMessage = 'Password must be at least 6 characters long.';
        isValid = false;
    }

    // Confirm password validation
    if (!confirmPassword) {
        errorMessage = 'Please confirm your password.';
        isValid = false;
    } else if (password !== confirmPassword) {
        errorMessage = 'Passwords do not match.';
        isValid = false;
    }

    if (!isValid) {
        alert(errorMessage);
    }

    return isValid;
}

// Product form validation
function validateProductForm() {
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value;
    const category = document.getElementById('category').value.trim();

    let isValid = true;
    let errorMessage = '';

    // Name validation
    if (!name) {
        errorMessage = 'Product name is required.';
        isValid = false;
    }

    // Price validation
    if (!price) {
        errorMessage = 'Price is required.';
        isValid = false;
    } else if (isNaN(price) || parseFloat(price) <= 0) {
        errorMessage = 'Please enter a valid price greater than 0.';
        isValid = false;
    }

    // Category validation
    if (!category) {
        errorMessage = 'Category is required.';
        isValid = false;
    }

    if (!isValid) {
        alert(errorMessage);
    }

    return isValid;
}

// Add event listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });
    }

    // Register form
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            if (!validateRegisterForm()) {
                e.preventDefault();
            }
        });
    }

    // Add product form
    const addProductForm = document.getElementById('addProductForm');
    if (addProductForm) {
        addProductForm.addEventListener('submit', function(e) {
            if (!validateProductForm()) {
                e.preventDefault();
            }
        });
    }

    // Edit product form
    const editProductForm = document.getElementById('editProductForm');
    if (editProductForm) {
        editProductForm.addEventListener('submit', function(e) {
            if (!validateProductForm()) {
                e.preventDefault();
            }
        });
    }
});

// Confirmation for delete actions
function confirmDelete(message = 'Are you sure you want to delete this item?') {
    return confirm(message);
}

// Add confirmation to all delete links
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('a[href*="delete"]');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (!confirmDelete()) {
                e.preventDefault();
            }
        });
    });
});
