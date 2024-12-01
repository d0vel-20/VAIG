<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | <?php echo isset($pageTitle) ? $pageTitle : "Default"; ?></title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    <script src=
"https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
      </script>

      
</head>


<body class=" text-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-[#1a1818] flex-shrink-0 flex flex-col fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Admin Panel</h1>
                <button id="close-sidebar" class="lg:hidden text-gray-200 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav class="flex-1 p-4 space-y-4">
                <a href="../admin/products.php" class="block text-white hover:text-blue-400">Products</a>
                <a href="#" class="block text-white hover:text-blue-400">Blogs</a>
            </nav>
            <div class="p-4 border-t flex flex-col items-left justify-center gap-4 border-gray-700">
                <a href="../admin/logout.php" class="block text-red-400 hover:text-red-600">Logout</a>
                <a href="#" class="block text-red-400 hover:text-red-600">Account</a>
            </div>
        </aside>
        <div class="flex-1">
    <!-- Navbar -->
    <header class="bg-gray-800 p-4 flex justify-between items-center lg:ml-0 fixed w-full lg:w-auto z-30">
        <div class="flex items-center">
            <button id="menu-toggle" class="lg:hidden text-gray-200 p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h2 class="ml-4 text-xl font-semibold text-white">Admin Dashboard</h2>
        </div>
    </header>



    
    <script>
    const menuToggle = document.getElementById("menu-toggle");
    const sidebar = document.getElementById("sidebar");
    const closeSidebar = document.getElementById("close-sidebar");

    menuToggle.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
    });

    closeSidebar.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
    });
</script>
</body>
</html>