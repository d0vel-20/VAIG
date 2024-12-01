<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VAIG | <?php echo isset($pageTitle) ? $pageTitle : "Default"; ?></title>
    <link rel="stylesheet" href="../public/index.css">
    <link rel="stylesheet" href="../public/output.css">
    <link rel="stylesheet" href="../public/input.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
                screens: {
                         'part': '740px', // Adds a custom breakpoint at 1440px
                     },
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
      </script>
      <link>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <style>

        /* fonts */
        .kanit-thin {
      font-family: "Kanit", sans-serif;
      font-weight: 100;
      font-style: normal;
    }
    
    .kanit-extralight {
      font-family: "Kanit", sans-serif;
      font-weight: 200;
      font-style: normal;
    }
    
    .kanit-light {
      font-family: "Kanit", sans-serif;
      font-weight: 300;
      font-style: normal;
    }
    
    .kanit-regular {
      font-family: "Kanit", sans-serif;
      font-weight: 400;
      font-style: normal;
    }
    
    .kanit-medium {
      font-family: "Kanit", sans-serif;
      font-weight: 500;
      font-style: normal;
    }
    
    .kanit-semibold {
      font-family: "Kanit", sans-serif;
      font-weight: 600;
      font-style: normal;
    }
    
    .kanit-bold {
      font-family: "Kanit", sans-serif;
      font-weight: 700;
      font-style: normal;
    }
    
    .kanit-extrabold {
      font-family: "Kanit", sans-serif;
      font-weight: 800;
      font-style: normal;
    }
    
    .kanit-black {
      font-family: "Kanit", sans-serif;
      font-weight: 900;
      font-style: normal;
    }
    
    .kanit-thin-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 100;
      font-style: italic;
    }
    
    .kanit-extralight-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 200;
      font-style: italic;
    }
    
    .kanit-light-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 300;
      font-style: italic;
    }
    
    .kanit-regular-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 400;
      font-style: italic;
    }
    
    .kanit-medium-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 500;
      font-style: italic;
    }
    
    .kanit-semibold-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 600;
      font-style: italic;
    }
    
    .kanit-bold-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 700;
      font-style: italic;
    }
    
    .kanit-extrabold-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 800;
      font-style: italic;
    }
    
    .kanit-black-italic {
      font-family: "Kanit", sans-serif;
      font-weight: 900;
      font-style: italic;
    }
    
        /* Custom styles for gradient background with light gold effect */
        .bg-gradient-light {
          background: radial-gradient(circle at center, rgba(255, 223, 186, 0.2), rgba(184, 134, 11, 0.8)),
                      linear-gradient(135deg, #FFD700, #B8860B);
        }
    
        /* Style for the search input with the icon inside */
        .search-bar {
          width: 200px;
          padding: 5px 6px;
          border-radius: 10px;
          border: 2px solid black;
          outline: none;
          transition: width 0.3s ease-in-out;
          font-size: 14px;
        }
    
        .search-bar:focus {
          width: 220px;
        }
    
        /* Adding search icon inside the search bar */
        .search-bar-container {
          display: flex;
          align-items: center;
          justify-content: center;
          position: relative;
        }
    
        .search-bar-container input {
          padding-left: 10px; /* Space for the search icon */
        }
    
        .search-bar-container i {
          position: absolute;
          right: 10px;
          top: 10px;
          color: #FFD700;
        }
        .bump{
            font-size: 25px;
        }
    
        .bg-gradient {
          background: linear-gradient(135deg, #dfd07b 30%, #c6b83d 70%, #FF9800 100%);
      }
        /* Mobile responsiveness: Display search bar on small screens too */
        @media (max-width: 768px) {
          .search-bar {
            width: 200px;
          }
    
          .search-bar:focus {
            width: 220px;
          }
        }
        /* Animation for sliding in from the right */
        .slide-in {
            transform: translateX(0); /* Make the element visible */
            transition: transform 0.3s ease-in-out; /* Smooth animation */
        }

        .slide-out {
            transform: translateX(100%); /* Hide the element to the right */
            transition: transform 0.3s ease-in-out; /* Smooth animation */
        }
      </style>
</head>
<body>
    <!-- nav -->
     <nav class="w-full fixed top-0 z-[998] bg-white  px-6  py-4 ">

        <div class="flex items-center justify-between">
            <div class="flex items-center justify-center gap-6">
                <button id="menu-btn" class="menu-btn text-lg lg:hidden">
                    <i class="fas fa-bars open-menu"></i>
                  </button>
                <!-- Logo -->
             <div class="kanit-regular text-lg">VAIG</div>
             <!-- searchbar -->
             <form action="../public/product.php" method="get" class="hidden md:flex items-center relative">
    <input 
        type="text" 
        name="query" 
        placeholder="Search products, categories, or brands" 
        class="h-[45px] outline-none bg-[#e2e1e1] rounded-md px-4 w-[400px] lg:w-[500px] focus:outline-purple-700"
        required
    >
    <button type="submit" class="w-8 h-8 bg-purple-700 flex items-center justify-center text-white rounded-full absolute right-3">
        <i class="fas fa-search text-sm"></i>
    </button>
</form>

            </div>
                <div class="flex items-center justify-center gap-4">
                     <!-- links -->
               <ul class="lg:flex items-center justify-center gap-4 hidden">
                <li><a href="../public/index.php" class="kanit-light text-sm">Home</a></li>
                <li><a href="../public/about.php" class="kanit-light text-sm">About</a></li>
                <li><a href="../public/product.php" class="kanit-light text-sm">Shop</a></li>
                <li><a href="../public/blog.php" class="kanit-light text-sm">Blog</a></li>
                <li><a href="../public/contact.php" class="kanit-light text-sm">Contact</a></li>
               </ul>
               <!-- Auth -->
                <div class="flex items-center justify-center gap-4">
                    <!-- <a href="../public/login.php" class="flex hover:text-white text-white w-[90px] h-[50px] rounded-[40px] items-center justify-center text-sm bg-purple-600 kanit-regular ext-md">Log In</a> -->
                    <a href="../public/cart.php" class="relative text-lg bump text-black">
                <img src="../public/Media/cart.png" class="h-6 w-6" alt="">
                <!-- Badge with cart item count -->
                <span id="cartBadge"  class="absolute bottom-4 left-4 w-5 h-5 text-xs font-bold text-white bg-red-500  rounded-full flex items-center justify-center">0</span>
              </a>
                </div>
                </div>
        </div>

        <!-- searchbar -->
        <form action="../public/product.php" method="get" class="flex md:hidden items-center relative">
    <input 
        type="text" 
        name="query" 
        placeholder="Search products, categories, or brands" 
        class="h-[40px] outline-none bg-[#e2e1e1] rounded-md w-full px-2 mt-2 focus:outline-purple-700"
        required
    >
    <button type="submit" class="w-6 h-6 bg-purple-700 flex items-center justify-center text-white rounded-full absolute top-4 right-3">
        <i class="fas fa-search text-sm"></i>
    </button>
</form>

     </nav>

<!-- Mobile Menu -->
<div id="mobile-menu" class="w-[50%] h-full bg-purple-700 fixed top-0 right-0 z-[999] slide-out invisible">
    <div class="flex flex-col text-white pt-6">
        <!-- Close Button -->
        <div class="flex justify-end pr-6">
            <button id="close-btn" class="text-2xl text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- Menu Links -->
        <div class="flex flex-col items-center justify-center pt-8">
            <ul class="w-full text-sm">
                <li class="py-4 border-b border-gray-500 w-full text-center hover:bg-purple-600 hover:text-gray-200 transition">
                    <a href="../public/index.php" class="block w-full">Home</a>
                </li>
                <li class="py-4 border-b border-gray-500 w-full text-center hover:bg-purple-600 hover:text-gray-200 transition">
                    <a href="../public/about.php" class="block w-full">About</a>
                </li>
                <li class="py-4 border-b border-gray-500 w-full text-center hover:bg-purple-600 hover:text-gray-200 transition">
                    <a href="../public/product.php" class="block w-full">Shop</a>
                </li>
                <li class="py-4 border-b border-gray-500 w-full text-center hover:bg-purple-600 hover:text-gray-200 transition">
                    <a href="../public/blog.php" class="block w-full">Blog</a>
                </li>
                <li class="py-4 w-full text-center hover:bg-purple-600 hover:text-gray-200 transition">
                    <a href="../public/contact.php" class="block w-full">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<script>
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalItems = cart.reduce((sum, product) => sum + product.quantity, 0);
    const cartBadge = document.getElementById("cartBadge");

    if (cartBadge) {
        cartBadge.textContent = totalItems;
        cartBadge.style.display = totalItems > 0 ? "flex" : "none";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    updateCartBadge();
});

        </script>
    <script src="../public/js/cart.js"></script>
    <script src="../public/index.js" defer></script>
</body>
</html>

