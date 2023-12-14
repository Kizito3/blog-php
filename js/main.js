const navItems = document.querySelector(".nav__items"),
      openNavBtn = document.querySelector("#open__nav-btn"),
      closeNavBtn = document.querySelector("#close__nav-btn");

const openNav = () => {
    navItems.style.display = 'flex';
    openNavBtn.style.display = 'none';
    closeNavBtn.style.display = 'inline-block';
}

const closeNav = () => {
    navItems.style.display = "none";
    openNavBtn.style.display = 'inline-block';
    closeNavBtn.style.display = 'none';
}

openNavBtn.addEventListener('click', openNav);

closeNavBtn.addEventListener('click', closeNav);




// ======================= SIDEBAR FUNCTIONALITY ============================

const aside = document.querySelector("aside"),
      showBtn = document.querySelector("#show__sidebar-btn"),
      hideBtn = document.querySelector("#hide__sidebar-btn");



const showSidebar = () => {
    aside.style.left= "0";
    showBtn.style.display = "none";
    hideBtn.style.display = "inline-block";
}

const hideSidebar = () => {
    aside.style.left= "-100%";
    showBtn.style.display = "inline-block";
    hideBtn.style.display = "none";
}

showBtn.addEventListener('click', showSidebar);
hideBtn.addEventListener('click', hideSidebar);