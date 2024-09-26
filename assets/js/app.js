const sideMenu = document.querySelector("aside");
const profileBtn = document.querySelector("#profile-btn");
const themeToggler = document.querySelector(".theme-toggler");
const nextDay = document.getElementById('nextDay');
const prevDay = document.getElementById('prevDay');

profileBtn.onclick = function() {
    sideMenu.classList.toggle('active');
}
window.onscroll = () => {
    sideMenu.classList.remove('active');
    if(window.scrollY > 0){document.querySelector('header').classList.add('active');}
    else{document.querySelector('header').classList.remove('active');}
}

// themeToggler.onclick = function() {
//     const elements = document.getElementsByTagName("*");
//     for (let i = 0; i < elements.length; i++) {
//   if (elements[i].getAttribute('data-bs-theme') == 'dark') {
//                 elements[i].setAttribute('data-bs-theme','light')
//             }
//             else {
//                 elements[i].setAttribute('data-bs-theme','dark')
//             }
// }
    

//     themeToggler.querySelector('span:nth-child(1)').classList.toggle('active')
//     themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')
// }
