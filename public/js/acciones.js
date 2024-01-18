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

    //toggle between music play and stop

    let buttons = document.getElementsByClassName('playPauseButton');
    let iconos = document.getElementsByClassName('playPauseImage');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function(){
            if (iconos[i].src.endsWith('35_Music_Player_icon-icons.com_61459.png')) {
                iconos[i].src = "../images/iconfinder-pause-stop-button-player-music-4593160_122283.png";
            } else {
                iconos[i].src = "../images/35_Music_Player_icon-icons.com_61459.png";
            }
        });
    };
    /*document.getElementById('playPauseButton').addEventListener('click', function() {
        var image = document.getElementById('playPauseImage');
        if (image.src.endsWith('35_Music_Player_icon-icons.com_61459.png')) {
            image.src = "../images/iconfinder-pause-stop-button-player-music-4593160_122283.png";
        } else {
            image.src = "../images/35_Music_Player_icon-icons.com_61459.png";
        }
        });*/
});
