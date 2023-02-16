
var teste = document.getElementById('teste').value;
if(teste == 1){
    document.getElementById("cont_overlay_seguidores").style.width = '100%';
}

function openNav(){

document.getElementById("nav").style.width = '75%';



}

function closeNav(){


    document.getElementById("nav").style.width = '0';

}


// seguidores 

function vis_seguidores(){

    
    document.getElementById("cont_overlay_seguidores").style.width = '100%';

}

function close_seguidores(){


    document.getElementById("cont_overlay_seguidores").style.width = '0';


}

// seguindo 

function vis_seguindo(){

    
    document.getElementById("cont_overlay_seguindo").style.width = '100%';

}

function close_seguindo(){


    document.getElementById("cont_overlay_seguindo").style.width = '0';


}
