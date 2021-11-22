{include file="templates/header.tpl"}


<div class="container-materias">
    <div class="text-center mt-3">
        {if  {$materia->imagen} }
            <img src="img/materia/{$materia->imagen}" class="imagen-item">
        {/if}
    </div>

    <div class="text-center mt-2">
        <ul>
            <li class="list-group-item mb-3" id="{$materia->nombre}">Materia | {$materia->nombre}</li>
            <li class="list-group-item">Profesor | {$materia->profesor}</li>
        </ul>
    </div>
</div>

<table>
    <thead>
        <tr>
            <td>Hora</td>
            <td>Usuario</td>
            <td>Comentario</td>
            <td>Puntaje</td>
            <td></td>

        </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
</table>


<form id="form-comentarios" data-idMateria="{$materia->id_materia}" data-idUsuario="{$id_usuario}"
    data-idHorario="{$id_usuario}" class="formulario-comentarios">

    <div class="form-group">
    {if $isLoggin} 
        <label>Comentar</label>
        <textarea type="text" name="comentario" id="comentario" value="" placeholder="escriba aqui su comentario"
            class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Puntaje</label>
        <select id="puntaje" class="form-control" required>
            <option value="1">★</option>
            <option value="2">★★</option>
            <option value="3">★★★</option>
            <option value="4">★★★★</option>
            <option value="5">★★★★★</option>
        </select>
    </div>

    <button type="submit" id="btn-comentar" class="btn btn-primary">comentar</button>
    {/if}
</form>

<div class="container-filtros">
    <form id="form_ordenar_puntaje" class="formulario_puntaje" data-idMateria="{$materia->id_materia}  data-idUsuario="
        {$id_usuario}>
        <select id="orden_puntaje" class="form-control">
            <option value="1">★</option>
            <option value="2">★★</option>
            <option value="3">★★★</option>
            <option value="4">★★★★</option>
            <option value="5">★★★★★</option>
        </select>
        <button type="" id="btn_puntaje" class="btn btn-primary">ordenar por puntaje</button>

    </form>

    <div class="filtros">
        <label>Ordenar por fecha</label>
        <button type="" id="btn-ordenar" class="btn btn-primary">ordenar</button>
    </div>
    <div class="filtros">
        <label>Deshacer filtros</label>
        <button type="" id="deshacer_filtro" class="btn btn-primary">Deshacer</button>
    </div>
</div>

<a href="carrera" class="volver">VOLVER</a>

{include file="templates/footer.tpl"}