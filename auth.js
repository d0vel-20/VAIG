
// login
document.addEventListener("DOMContentLoaded", function () {
    const formData = {
        email: '',
        password: ''
    };

    const errors = {};

    const validateEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    };

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        formData[name] = value;

        // Clear errors on input change
        if (errors[name]) {
            delete errors[name];
            updateErrorMessages();
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        let validationErrors = {};

        if (!validateEmail(formData.email)) {
            validationErrors.email = 'Please enter a valid email address.';
        }
        if (!formData.password) {
            validationErrors.password = 'Please enter your password.';
        }

        if (Object.keys(validationErrors).length > 0) {
            Object.assign(errors, validationErrors);
            updateErrorMessages();
        } else {
            // Proceed with form submission logic (e.g., send data to API)
            console.log("Form data submitted: ", formData);
            // Clear the form after submission
            document.getElementById("login-form").reset();
        }
    };

    const updateErrorMessages = () => {
        const emailError = document.getElementById('email-error');
        const passwordError = document.getElementById('password-error');

        emailError.textContent = errors.email || '';
        passwordError.textContent = errors.password || '';
    };

    document.getElementById('email').addEventListener('input', handleInputChange);
    document.getElementById('password').addEventListener('input', handleInputChange);
    document.getElementById('login-form').addEventListener('submit', handleSubmit);

    // Show/Hide password functionality
    document.getElementById('show-password').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const showPasswordBtn = document.getElementById('show-password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showPasswordBtn.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            showPasswordBtn.textContent = 'Show';
        }
    });
});






// sighn up
const form = document.getElementById('signupForm');
const fullNameInput = document.getElementById('fullName');
const lastNameInput = document.getElementById('lastName');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const togglePasswordButton = document.getElementById('togglePassword');

// Error elements
const fullNameError = document.getElementById('fullNameError');
const lastNameError = document.getElementById('lastNameError');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');

const validateEmail = (email) => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
};

const validatePassword = (password) => {
  const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{16,}$/;
  return passwordRegex.test(password);
};

// Toggle password visibility
togglePasswordButton.addEventListener('click', () => {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    togglePasswordButton.textContent = 'Hide';
  } else {
    passwordInput.type = 'password';
    togglePasswordButton.textContent = 'Show';
  }
});

// Handle form submission
form.addEventListener('submit', (e) => {
  e.preventDefault();
  let hasErrors = false;

  // Full Name validation
  if (fullNameInput.value === '') {
    fullNameError.classList.remove('hidden');
    hasErrors = true;
  } else {
    fullNameError.classList.add('hidden');
  }

  // Last Name validation
  if (lastNameInput.value === '') {
    lastNameError.classList.remove('hidden');
    hasErrors = true;
  } else {
    lastNameError.classList.add('hidden');
  }

  // Email validation
  if (!validateEmail(emailInput.value)) {
    emailError.classList.remove('hidden');
    hasErrors = true;
  } else {
    emailError.classList.add('hidden');
  }

  // Password validation
  if (!validatePassword(passwordInput.value)) {
    passwordError.classList.remove('hidden');
    hasErrors = true;
  } else {
    passwordError.classList.add('hidden');
  }

  // If no errors, proceed with form submission (e.g., send data to the server)
  if (!hasErrors) {
    console.log('Form submitted:', {
      fullName: fullNameInput.value,
      lastName: lastNameInput.value,
      email: emailInput.value,
      password: passwordInput.value
    });
  }
});