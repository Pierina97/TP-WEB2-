"use strict";

let app = new Vue({
    //elemtno que quiero que tenga alcance
    el: "#app-comentarios",
    //que variable quiero pasarle a este html
    data: {
        comentarios: []
 
    },
    methods:{
        eliminarComentario:function(comentario){
        borrarComentario(comentario);
        }
    }

 
});


const API_URL = `api/comentarios`;
const form_comentarios = document.querySelector("#form-comentarios");
let admin = form_comentarios.getAttribute('data-idAdmin');



    let id_materia = form_comentarios.getAttribute('data-idMateria');
    let url = `${API_URL}/materia/${id_materia}`;
   


    async function cargaComentarios(url) {

        try {

            let response = await fetch(url);
            if (response.ok) {

                let comentarios = await response.json();
                console.log(comentarios);
                app.comentarios=comentarios;
     
            } else {
                console.log("Error - Failed URL!", response.status);
            }
        } catch (error) {
            console.log("Connection error", error);
        }

    }

    cargaComentarios(url);
    document.querySelector("#deshacer_filtro").addEventListener("click", e => {
        cargaComentarios(url);
    });

   

    /*POST*/
    form_comentarios.addEventListener('submit', e => {
        e.preventDefault();
        añadirComentario();
        form_comentarios.reset()
    });

    async function añadirComentario() {


        let objeto = crearComentario();
        try {
            let response = await fetch(API_URL, {
                "method": "POST",
                "headers": { "Content-Type": "application/json" },
                "body": JSON.stringify(objeto)
            })
            if (response.ok) {
                console.log("http 200");
          
                 cargaComentarios(url);

            } else if (response.status == 201) {
                console.log("http 201", response.status);
            } else {
                console.log("http error", response.status);
            }
        } catch (error) {
            console.log(error);
        }
    }

    function crearComentario() {

        let formData = new FormData(form_comentarios);
        let fecha = form_comentarios.getAttribute('data-idfecha');
        let id_usuario = form_comentarios.getAttribute('data-idUsuario');
        let comentario = formData.get('comentario');
        let puntaje = document.querySelector("#puntaje").value;
        let id_materia = form_comentarios.getAttribute('data-idMateria');

        let comment = {
            "fecha": fecha,
            "comentario": comentario,
            "puntaje": puntaje,
            "id_materia": id_materia,
            "id_usuario": id_usuario
        };
        console.log(comment);
        return comment;
    }


    async function borrarComentario(id_comentario) {


        try {
            let response = await fetch(`${API_URL}/${id_comentario}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json"
                }
            });
            if (response.ok) {
                console.log(response.status);
                cargaComentarios(url);
            } else {
                console.log("No se pudo eliminar", response.status);
            }
        } catch (error) {
            console.log(error);
            console.log(response.status);
        }
    }
    //ordenar por antiguedad
    let btn_ordenar = document.querySelector("#btn-ordenar");

    btn_ordenar.addEventListener('click', e => {
        let url = `${API_URL}/materia/${id_materia}/fecha/asc`;
        cargaComentarios(url);
    });

    form_ordenar_puntaje.addEventListener('submit', e => {
        e.preventDefault();
        ordenarPorPuntaje();
    });

    function ordenarPorPuntaje() {
        let puntaje = document.querySelector("#orden_puntaje").value;
        let url = `${API_URL}/materia/${id_materia}/puntaje/${puntaje}`;
        cargaComentarios(url);
    }


