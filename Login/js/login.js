const cont = document.querySelector('.container');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
registerLink.addEventListener('click',() => {
    cont.classList.add('active');
});
loginLink.addEventListener('click',() => {
    cont.classList.remove('active');
});

const search = document.getElementById('search'),
      searchBtn = document.getElementById('search-btn'),
      searchClose = document.getElementById('searchclose')
searchBtn.addEventListener('click', () =>{
   search.classList.add('show-search')
})
searchClose.addEventListener('click', () =>{
   search.classList.remove('show-search')
})

const aicon = document.querySelector('.aicon');
const alogin = document.querySelector('.alogin');
aicon.onclick =function(){
    alogin.classList.toggle('active');
}