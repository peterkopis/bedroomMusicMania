document.addEventListener('DOMContentLoaded', (event) => {
    
    //toglle de formulario de subir un archivo de musica
    function toggleForm(TForm, btn)
    {
        if(TForm.style.display == "none"){
            TForm.style.display = "block";
            btn.innerText = 'Hide it';
        } else {
            TForm.style.display = 'none';
            btn.innerText = 'You want add a new song?';
        }
    }

    let btnToggler = document.getElementById('toggler');
    let uploadForm = document.getElementById('uploadForm');
    btnToggler.addEventListener('click', function(){
        toggleForm(uploadForm, btnToggler);
    });
});
