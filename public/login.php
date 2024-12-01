<?php 
    $pageTitle = "Login";
  include '../includes/config.php';
  include '../includes/header.php';

?>


  <!-- form -->
  <section class="min-h-[60vh] flex justify-center items-center bg-purple-600 p-6 mt-20">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 ">
        <h2 class="text-2xl font-semibold text-center mb-6 kanit-regular">Login to Your Account</h2>
        <form id="login-form" noValidate>
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required />
                <p class="text-red-500 text-xs mt-1" id="email-error"></p> <!-- Placeholder for error message -->
            </div>
    
            <!-- Password -->
            <div class="mb-6 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    required />
                <button type="button" id="show-password" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                    Show
                </button>
                <p class="text-red-500 text-xs mt-1" id="password-error"></p> <!-- Placeholder for error message -->
            </div>
    
            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full py-2 px-4 bg-purple-600 text-white font-semibold rounded-md shadow  hover:bg-purple-500 kanit-light focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Login
                </button>
                <p class="text-center text-[13px] mt-3 kanit-light "><span>Don't have an Account? </span><a class="text-red-600" href="../public/register.php">Sign Up</a></p>
            </div>
        </form>
    </div>
  </section>

  <?php include '../includes/footer.php'; ?>




     