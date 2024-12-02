     // Elements
     const menuBtn = document.getElementById('menu-btn');
     const mobileMenu = document.getElementById('mobile-menu');
     const closeBtn = document.getElementById('close-btn');

      // Open mobile menu
 menuBtn.addEventListener('click', () => {
     if (mobileMenu.classList.contains('invisible')) {
         mobileMenu.classList.remove('invisible', 'slide-out');
         mobileMenu.classList.add('slide-in');
     }
 });

 // Close mobile menu
 closeBtn.addEventListener('click', () => {
     mobileMenu.classList.remove('slide-in');
     mobileMenu.classList.add('slide-out');
     setTimeout(() => {
         mobileMenu.classList.add('invisible'); // Hide after animation
     }, 300); // Match transition duration
 });

// FAQ Data
const faqs = [
{
  question: "Who are Vision Africa Investment Group?",
  answer:
    "At Vision Africa Investment Group, we specialize in connecting foreign manufacturers with local African retailers, partners, and distributors of cutting-edge electronics. Our mission is to empower local businesses by providing access to a diverse range of high-quality products that enhance everyday life and drive economic growth.",
},
{
  question: "Does VAIG sell products",
  answer:
    "VAIG are marketers and distributors of smart product, home electronics appliances ,mobile phones, solar energy products etc",
},
{
  question: "Discount on Advertising?",
  answer:
    "VAIG offers a cost-effective solution for connecting with quality distributors. Unlike trade shows or agencies that are time-consuming and expensive, VA connects you with vetted distributors at a fraction of the cost.",
},
];

// Generate FAQ HTML
const faqContainer = document.getElementById("faq-container");
let activeIndex = null;

const toggleFAQ = (index) => {
activeIndex = activeIndex === index ? null : index;
renderFAQs();
};

const renderFAQs = () => {
faqContainer.innerHTML = faqs.map((faq, index) => `
  <div class="border-b border-gray-300 pb-4">
    <div class="flex justify-between items-center cursor-pointer" onclick="toggleFAQ(${index})">
      <h3 class="text-xl  kanit-light">${faq.question}</h3>
      <span>${activeIndex === index ? '-' : '+'}</span>
    </div>
    ${activeIndex === index ? `<p class="mt-4 text-gray-600 kanit-light">${faq.answer}</p>` : ''}
  </div>
`).join('');
};

// Initial Render
renderFAQs();
