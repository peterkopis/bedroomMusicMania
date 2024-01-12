document.addEventListener('DOMContentLoaded', (event) => {
    
    //toglle de formulario de subir un archivo de musica
    function toggleForm(TForm, btn)
    {
        if(TForm.style.display == "none"){
            TForm.style.display = "block";
        } else {
            TForm.style.display = 'none';
        }
    }

    let btnToggler = document.getElementById('toggler');
    let uploadForm = document.getElementById('uploadForm');
    btnToggler.addEventListener('click', function(){
        toggleForm(uploadForm, btnToggler);
    });
});
