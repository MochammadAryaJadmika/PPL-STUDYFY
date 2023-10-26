const collapsibleButtons = document.querySelectorAll(".collapsible");

// Add click event listeners to collapsible buttons
collapsibleButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const submenu = button.nextElementSibling; // Use nextElementSibling
    if (submenu.style.display === "block" || submenu.style.display === "") {
      submenu.style.display = "none";
    } else {
      submenu.style.display = "block";
    }
  });
});

const userMenuToggle = document.getElementById('user-menu-toggle');
const userMenu = document.getElementById('user-menu');

userMenuToggle.addEventListener('click', () => {
  userMenu.classList.toggle('hidden');
});

// Fungsi untuk mengatur item aktif (menu dll)
function setActiveItem(activeId) {
  const sidebarItems = document.querySelectorAll("aside a");
  sidebarItems.forEach((item) => {
    item.classList.remove("bg-green-600");
    item.classList.remove("text-gray-100");
  });

  const activeItem = document.getElementById(activeId);
  if (activeItem) {
    activeItem.classList.add("bg-blue-800");
    activeItem.classList.add("text-gray-100");
  }
}

// Set item aktif pada "profil" saat halaman di load pertama kali
setActiveItem("profil");
