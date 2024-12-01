
<?php 
  $pageTitle = "Home";
  include '../includes/config.php';
  include '../includes/header.php';



  $stmt = $conn->prepare("SELECT * FROM products LIMIT 12");
  $stmt->execute();
  $result = $stmt->get_result();

?>





<section class="w-full h-[fit-content] pb-[10px] md:h-[60vh] lg:h-[100vh] bg-gradient-to-t from-purple-400 to-white flex flex-col lg:flex-row items-center mt-[180px] md:mt-[100px] lg:mt-[60px]">
  <!-- Left Part: Text Content -->
  <div class="w-full lg:w-1/2 px-4 lg:px-16 text-center lg:text-left mb-8 lg:mb-0">
    <h1 class="text-2xl md:text-4xl lg:text-5xl kanit-regular text-gray-800 mb-4">
      Vision Africa Investment Group
    </h1>
    <p class=" md:text-lg lg:text-xl kanit-light text-gray-600">
    Leading importers and distributors of electronics and electrical appliances in Nigeria. <br> Vision Africa Investment Group are marketers and distributors of OMNI brand products, TOGO solar power products
    </p>
  </div>

  <!-- Right Part: Image Grid -->
  <div class="w-full lg:w-1/2 grid grid-cols-2 gap-4 px-6 lg:px-16">
    <!-- Top Left Image -->
    <div class="relative h-36 md:h-40 lg:h-48 bg-cover bg-center rounded-[20px]  transition" 
         style="background-image: url('https://res.cloudinary.com/da1sagzgc/image/upload/v1728223951/istockphoto-182883783-612x612_qfloil.jpg');">
      <div class="absolute inset-0  rounded-[20px] flex items-center justify-center text-white text-sm font-semibold">
        <p class="px-4 py-1 bg-purple-600 rounded-md kanit-light">Audio devices</p>
      </div>
    </div>

    <!-- Top Right Image -->
    <div class="relative h-36 md:h-40 lg:h-48 bg-cover bg-center rounded-[20px]  transition" 
         style="background-image: url('https://res.cloudinary.com/da1sagzgc/image/upload/v1727475747/solar_ztnuwv.png');">
      <div class="absolute inset-0  flex items-center rounded-[20px] justify-center text-white text-sm font-semibold">
      <p class="px-4 py-1 bg-purple-600 rounded-md kanit-light">Solar Power</p>
      </div>
    </div>

    <!-- Bottom Full-Width Image -->
    <div class="relative col-span-2 h-40 md:h-48 lg:h-64 bg-cover bg-center rounded-[20px]  transition" 
         style="background-image: url('https://res.cloudinary.com/da1sagzgc/image/upload/v1727470224/hero_etugac.jpg');">
      <div class="absolute inset-0  rounded-[20px] flex items-center justify-center text-white text-sm font-semibold">
      <p class="px-4 py-1 bg-purple-600 rounded-md kanit-light">General Electronics</p>
        
      </div>
    </div>
  </div>
</section>

<section class="py-10 px-4 md:px-12">
  <div class="flex items-center justify-between mb-6">
      <h2 class="text-[21px] md:text-2xl  kanit-regular ">Shop varieties of electronics</h2>
      <a href="../public/product.php" class="text-purple-700 text-sm kanit-light">View more</a>
  </div>

    <div class="grid gap-6 grid-cols-2 md:grid-cols-3 lg:grid-cols-6">
      <!-- Product Card 1 -->
      <?php while ($product = $result->fetch_assoc()): ?>
                    <a href="../public/product_id.php?id=<?= $product['id'] ?>" class="group block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="relative">
                            <img src="<?= '../uploads/' . $product['image'] ?>" alt="<?= $product['name'] ?>" class="w-full h-40 object-cover">
                        </div>
                        <div class="p-2">
                            <p class="text-gray-800 text-[12px] kanit-light"><?= $product['name'] ?></p>
                            <p class="text-gray-800 text-[12px] text-purple-700 kanit-light">$<?= $product['price'] ?></p>
                        </div>
                    </a>
                    <?php endwhile; ?>

      <!-- Add more product cards as needed -->

    </div>
  </section>


<!-- CATEGORIES ================================================================================ -->
<section class="py-10 bg-gray-50">
  <div class="container mx-auto px-4">
    <h2 class="text-2xl kanit-regular mb-6">Our Categories</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
      <!-- Category Card 1 -->
      <div class="relative">
        <img src="https://res.cloudinary.com/da1sagzgc/image/upload/v1727470224/hero_etugac.jpg" alt="Category 1" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">General Electronics</p>
      </div>

      <!-- Category Card 2 -->
      <div class="relative">
        <img src="https://res.cloudinary.com/da1sagzgc/image/upload/v1727475747/solar_ztnuwv.png" alt="Category 2" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Solar Power Devices</p>
      </div>

      <!-- Category Card 3 -->
      <div class="relative">
        <img src="../public/Media/home-cat.png" alt="Category 3" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Home Entertainment</p>
      </div>

      <!-- Category Card 4 -->
      <div class="relative">
        <img src="https://res.cloudinary.com/da1sagzgc/image/upload/v1728223951/istockphoto-182883783-612x612_qfloil.jpg" alt="Category 4" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Audio Devices</p>
      </div>

      <!-- Category Card 5 -->
      <div class="relative">
        <img src="../public/Media/camera-cat.png" alt="Category 5" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Cameras & Photography</p>
      </div>

      <!-- Category Card 6 -->
      <div class="relative">
        <img src="../public/Media/mobile-cat.jpg" alt="Category 6" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Mobile Devices</p>
      </div>

      <!-- Category Card 7 -->
      <div class="relative">
        <img src="../public/Media/kitchen-cat.jpg" alt="Category 7" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Kitchen Appliances</p>
      </div>

      <!-- Category Card 8 -->
      <div class="relative">
        <img src="../public/Media/surveilliance-cat.jpeg" alt="Category 8" class="w-full h-40 object-cover rounded-md">
        <div class="absolute inset-0 rounded-md bg-gradient-to-t from-black/60 to-transparent"></div>
        <p class="absolute bottom-2 left-2 text-white font-semibold text-sm">Surveliance Cameras</p>
      </div>
    </div>
  </div>
</section>

<section class="bg-purple-700 py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Title and Sub-description -->
    <div class="text-white">
      <h2 class="text-2xl kanit-regular mb-4 text-white">Our Brands</h2>
      <p class="mt-2 text-md kanit-light text-white">
      Vision Africa Investment Group are marketers and distributors of OMNI brand products, TOGO solar power products
      </p>
    </div>

    <!-- Brand Logos -->
    <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-8">
      <!-- Shile Speakers -->
      <div class="flex justify-center items-center">
        <img 
          src="../public/Media/shile.png" 
          alt="Shile Speakers Logo" 
          class="h-50 w-50 object-contain"
        />
      </div>

      <!-- Omni Products -->
      <div class="flex justify-center items-center">
        <img 
          src="../public/Media/omni.jpg" 
          alt="Omni Products Logo" 
          class="h-50 w-50 object-contain"
        />
      </div>

      <!-- Togo Products -->
      <div class="flex justify-center items-center">
        <img 
          src="togo-logo.jpg" 
          alt="Togo Products Logo" 
          class="h-24 w-24 object-contain"
        />
      </div>
    </div>
  </div>
</section>








      <!-- Latest Blogs-------------------------------------------------------------------------- -->
      <section class="py-12 px-6 md:px-12 bg-[#262525]">
        <div class="max-w-7xl mx-auto">
          <h2 class="text-2xl   mb-4  text-white kanit-regular">Read Latest Blogs</h2>
          <h2 class="text-sm  mb-8  text-white kanit-light">Read various topics and discussions that matter to you....</h2>
          <div id="blog-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Blog cards will be inserted here by JavaScript -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
              <img src="https://res.cloudinary.com/da1sagzgc/image/upload/v1727475747/solar_ztnuwv.png" alt="" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-2xl mb-2 kanit-regular">Why use solar energy</h3>
                <p class="text-gray-700 text-sm mb-4 kanit-light">Solar Power generators; the money saver energy provider for your home and office needs.</p>
                <div class="flex justify-between items-center">
                  <span class="text-gray-500 text-sm">September 25, 2024</span>
                  <a href="./blog.html" class="text-white bg-purple-600 py-2 px-4 rounded-md hover:underline kanit-light">Read More →</a>
                </div>
              </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
              <img src="https://res.cloudinary.com/da1sagzgc/image/upload/v1728223499/Impact-of-eCommerce-On-Society_kezrjw.png" alt="" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-2xl mb-2 kanit-regular">How to Increase Conversion</h3>
                <p class="text-gray-700 text-sm mb-4 kanit-light">Boost your sales by optimizing your website for conversions...</p>
                <div class="flex justify-between items-center">
                  <span class="text-gray-500 text-sm kanit-light">September 25, 2024</span>
                  <a href="./blog.html" class="text-white bg-purple-600 py-2 px-4 rounded-md hover:underline kanit-light">Read More →</a>
                </div>
              </div>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition duration-300">
              <img src="https://via.placeholder.com/600x400.png?text=Blog+3+Image" alt="" class="w-full h-48 object-cover">
              <div class="p-6">
                <h3 class="text-2xl mb-2 kanit-regular">How to Increase Conversion</h3>
                <p class="text-gray-700 text-sm mb-4 kanit-light">Boost your sales by optimizing your website for conversions...</p>
                <div class="flex justify-between items-center">
                  <span class="text-gray-500 text-sm kanit-light">September 25, 2024</span>
                  <a href="./blog.html" class="text-white bg-purple-600 py-2 px-4 rounded-md hover:underline kanit-light">Read More →</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>




    <!-- =FAQ=============================================================== -->
    <section class="py-12 px-6 md:px-12 bg-gray-50">
        <div class="faq-section mx-auto">
          <h2 class="text-4xl mb-8 text-center kanit-regular">Frequently Asked Questions</h2>
          <div id="faq-container" class="space-y-4">
            <!-- FAQ Items will be inserted here -->
             
          </div>
        </div>
      </section>
     

            

  <?php include '../includes/footer.php'; ?>




     