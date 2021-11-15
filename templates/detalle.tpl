{include file="templates/header.tpl"}

<div class="container mt-2">

    <ul class="list-group">
        <li class="list-group-item mb-3" id= "{$materia->nombre}">Materia | {$materia->nombre}</li>
        <button id="materia">
            <li class="list-group-item">Profesor | {$materia->profesor}</li>
        </button>
    </ul>
</div>
{if isset($materia->imagen)}
    <img src="{$materia->imagen}" />
{/if}

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
<button type="" id="btn-ordenar" class="btn btn-primary">ordenar ASC</button>

<form id="form-comentarios" data-idMateria="{$materia->id_materia}" data-idUsuario="{$id_usuario}"  data-idHorario="{$id_usuario}"  class="formulario-comentarios">
    <input type="text" name="comentario" id="comentario" value="" placeholder="escriba aqui su comentario" required>
    {* <textarea rows="2" name="detalle" placeholder="Ingresa su comentario"></textarea> *}
    <input type="number" name="puntaje" id="puntaje" value="" placeholder="puntaje" required>
    <button type="submit" id="btn-comentar" class="btn btn-primary">Enviar Consulta</button>
</form>

</div>

<a href="carrera" class="volver">VOLVER</a>
{include file="templates/footer.tpl"}