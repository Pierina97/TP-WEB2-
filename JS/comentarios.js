"use strict";

// document.addEventListener("DOMContentLoaded", iniciarPagina);

// function iniciarPagina() {


const API_URL = `http://localhost/TRABAJOPRACTICOESPECIALWEB2/api/comentarios`;
const form_comentarios = document.querySelector("#form-comentarios");
let comentarios = [];
/*GET*/
async function cargaComentarios() {

    try {

        let id_materia = form_comentarios.getAttribute('data-idMateria');
        let response = await fetch(`${API_URL}/materia/${id_materia}`);
        if (response.ok) {

            comentarios = await response.json();
            console.log(comentarios);
            tbody.innerHTML = " ";
            for (let comentario of comentarios) {
                mostrarTabla(comentario);
            }
        } else {
            console.log("Error - Failed URL!");
        }
    } catch (error) {
        console.log("Connection error");
    }

}
cargaComentarios();

function mostrarTabla(comentario) {

    let tbody = document.querySelector('#tbody');
    let filas = document.createElement('tr');

    let celda_fecha = document.createElement('td');
    let celda_nombre = document.createElement('td');
    let celda_comentario = document.createElement('td');
    let celda_puntaje = document.createElement('td');
    let celda_borrar = document.createElement('td');

    let btnBorrar = document.createElement('button');

    celda_fecha.innerHTML = comentario.fecha;
    celda_nombre.innerHTML = comentario.nombre;
    celda_comentario.innerHTML = comentario.comentario;
    celda_puntaje.innerHTML = comentario.puntaje;

    btnBorrar.innerHTML = "Borrar";

    btnBorrar.setAttribute('data-id', comentario.id_comentario);

    btnBorrar.classList.add('btn-borrar');

    filas.appendChild(celda_fecha);
    filas.appendChild(celda_nombre);
    filas.appendChild(celda_comentario);
    filas.appendChild(celda_puntaje);


    filas.classList.add(`fila-${comentario.id_comentario}`);

    filas.appendChild(celda_borrar);
    celda_borrar.appendChild(btnBorrar);
    tbody.appendChild(filas);



    let botonesBorrar = document.querySelectorAll(".btn-borrar");
    botonesBorrar.forEach(e => {
        e.addEventListener("click", borrarComentario);
    });
}
/*POST*/
form_comentarios.addEventListener('submit', e => {
    e.preventDefault();
    añadirComentario();
});

async function añadirComentario() {

    console.log("click");
    let objeto = crearComentario();
    try {
        let response = await fetch(API_URL, {
            "method": "POST",
            "headers": { "Content-Type": "application/json" },
            "body": JSON.stringify(objeto)
        })
        if (response.ok) {
            console.log("http 200");
            console.log(objeto);
            cargaComentarios();
            mostrarTabla(objeto);
        } else if (response.status == 201) {
            console.log("http 201");
        } else {
            console.log("http error");
        }
    } catch (error) {
        console.log(error);
    }
}

function crearComentario() {

    let formData = new FormData(form_comentarios);
    let fecha = form_comentarios.getAttribute('data-idfecha');
    let comentario = formData.get('comentario');
    let puntaje = formData.get('puntaje');
    let id_usuario = form_comentarios.getAttribute('data-idUsuario');
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

async function borrarComentario() {
    let id_comentario = this.getAttribute("data-id");
    console.log(id_comentario);
    try {
        let response = await fetch(`${API_URL}/${id_comentario}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json"
            }
        });
        if (response.ok) {
            cargaComentarios();
        } else {
            console.log("No se pudo eliminar");
        }
    } catch (error) {
        console.log(error);
    }

}
