const header = document.querySelector('.header__nav');
const iconMenu = document.querySelector('.header__menu-icon');
const closeBtn = document.querySelector('.header__menu-icon-close');


function toggleMenu(){
    const display = header.style.display
    if(display == '' || display == 'none'){
        header.style.display = 'flex'
        return;
    }
    header.style.display = 'none'
}

if(iconMenu){
    iconMenu.addEventListener('click', toggleMenu)
}

if(closeBtn){
    closeBtn.addEventListener('click', toggleMenu)
}