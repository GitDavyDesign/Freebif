const role = document.getElementsByClassName("roles");
const work = document.getElementById("works");

Array.from(role).forEach(role => {role.addEventListener('click', e=>{
    if (e.target.value === 'ROLE_FREELANCE'){
        work.style.display = 'block';
    }
    if(e.target.value === 'ROLE_CLIENTS'){
        work.style.display = 'none';
    }
})})
