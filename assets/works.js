const role = document.getElementsByClassName("roles");
const work = document.getElementById("works");

Array.from(role).forEach(role => {role.addEventListener('click', e=>{
    if (e.target.value === 'FREELANCE'){
        work.style.display = 'block';
    }
    else{
        work.style.display = 'none';
    }
})})
