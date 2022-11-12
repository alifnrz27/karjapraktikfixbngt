// navbar fixed
window.onscroll = function(){
    const header = document.querySelector('#navbar');
    const fixedNav = header.offsetTop;
    const toTop = document.querySelector('#toTop');

    if(window.pageYOffset > fixedNav){
        header.classList.add('navbar-fixed');
        toTop.classList.remove('hidden');
        toTop.classList.add('flex');
    }else{
        header.classList.remove('navbar-fixed');
        toTop.classList.remove('flex');
        toTop.classList.add('hidden');
    }
}

// back to top
function backToTop(){
    $('body,html').animate({
            scrollTop: 0
        }, 800);
}

// dark mode toggle
const darkToggle = document.querySelector('#dark-toggle');
const html = document.querySelector('html');
darkToggle.addEventListener('click', function(){
    if(darkToggle.checked) {
        html.classList.add('dark');
        localStorage.theme = 'dark';
    }
    else{
        html.classList.remove('dark');
        localStorage.theme = 'light';
    }
});

// pindahkan posisi toggle sesuai mode
// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    darkToggle.checked = true;
} else {
    darkToggle.checked = false;
}

// open pop up
function tampilPopup($id){
    const popup = document.getElementById($id);
    popup.classList.add('block');
    popup.classList.add('pop-up');
    popup.classList.remove('hidden');
}

function sembunyiPopup($id){
    const popup = document.getElementById($id);
    popup.classList.remove('block');
    popup.classList.remove('pop-up');
    popup.classList.add('hidden');
}

// status
const statusData = document.querySelector('#status');
setTimeout(function(){
    statusData.style.display = 'none';
}, 1000);