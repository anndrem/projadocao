const $ = (e) => document.querySelector(e); 

const btn = $('galeria')
const div = $('popup')

btn.addEventlistener("click", () => {div.style.visibility = 'visible'});