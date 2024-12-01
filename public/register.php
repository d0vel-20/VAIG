
<?php 
  $pageTitle = "Sign Up";
  include '../includes/config.php';
  include '../includes/header.php';

?>
    
  <section class="min-h-[60vh] flex justify-center items-center bg-purple-600 p-6 mt-20">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-semibold text-center mb-6 kanit-regular">Sign up to start shopping</h2>
        <form id="signupForm" novalidate>
          <!-- Full Name -->
          <div class="mb-4">
            <label for="fullName" class="block text-sm font-medium text-gray-700">
              Full Name
            </label>
            <input type="text" id="fullName" name="fullName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <p id="fullNameError" class="error hidden text-red-600 text-[12px]">Please enter your full name.</p>
          </div>
    
          <!-- Last Name -->
          <div class="mb-4">
            <label for="lastName" class="block text-sm font-medium text-gray-700">
              Last Name
            </label>
            <input type="text" id="lastName" name="lastName" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <p id="lastNameError" class="error hidden  text-red-600 text-[12px]">Please enter your last name.</p>
          </div>
    
          <!-- Email -->
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">
              Email Address
            </label>
            <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <p id="emailError" class="error hidden text-red-600 text-[12px]">Please enter a valid email address.</p>
          </div>
    
          <!-- Password -->
          <div class="mb-6 relative">
            <label for="password" class="block text-sm font-medium text-gray-700">
              Password
            </label>
            <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
              Show
            </button>
            <p id="passwordError" class="error hidden text-red-600 text-[12px]">Password must be at least 16 characters long, contain a number, a capital letter, and a special character.</p>
          </div>
    
          <!-- Submit Button -->
          <div class="mb-4">
            <button type="submit" class="w-full py-2 px-4 bg-purple-600 text-white kanit-light rounded-md shadow hover:bg-purple-500 ">
              Sign Up
            </button>
            <p class='text-center text-[13px] mt-4 kanit-light'>
              <span>Already have an Account? </span>
              <a href="../public/login.php" class='text-red-600'>Login</a>
            </p>
          </div>
        </form>
      </div>
</section>

<?php include '../includes/footer.php'; ?>


     