
<?php 
  $pageTitle = "Contact";
  include './includes/config.php';
  include './includes/header.php';

?>


<div class="container mx-auto py-12 px-4 mt-14 bg-gray-50 " >
    <div class="grid md:grid-cols-2 gap-8 items-start bg-gray-50 rounded-lg p-8">
      <!-- Left Section -->
      <div>
        <h1 class="text-3xl mb-6 kanit-regular">Contact us</h1>
        <p class="text-gray-700 leading-relaxed mb-6 kanit-light">
        Leading importers and distributors of electronics and electrical appliances in Nigeria. We provide high-quality, reliable products to meet the needs of our clients.
        </p>
        <div class="mb-4">
          <p class="text-gray-800 kanit-regular">Email:</p>
          <a href="mailto:aify.global@yahoo.com" class="text-blue-600 hover:underline kanit-light">ezeegeorge1@gmail.com</a>
        </div>
        <div class="mb-6">
          <p class="text-gray-800 kanit-regular">Phone:</p>
          <a href="tel:+2347036286321" class="text-blue-600 hover:underline kanit-light">+234 816 851 0007</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <p class="text-gray-800  kanit-regular">Owerri Office:</p>
            <p class="text-gray-700 text-sm kanit-light">#122 Wetheral Road, by Christ Church Road
            Owerri, Imo State</p>
          </div>
          <div>
            <p class="text-gray-800  kanit-regular">Lagos Office:</p>
            <p class="text-gray-700 text-sm kanit-light">#19 Joachim Otunba Street,
            off Ago Palace Way, Okota.</p>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl mb-6 kanit-regular">Send us a message</h2>
        <form action="#" method="POST" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="fullname" placeholder="Full Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
            <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
          </div>
          <input type="text" name="phone" placeholder="Phone Number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
          <input type="text" name="location" placeholder="Location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600">
          <textarea name="message" rows="4" placeholder="Message" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600"></textarea>
          <button type="submit" class="w-full bg-purple-600 text-white kanit-light py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600">Send</button>
        </form>
      </div>
    </div>
  </div>


  <?php include './includes/footer.php'; ?>




     