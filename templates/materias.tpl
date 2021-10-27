{include file='templates/header.tpl'}

<div class="container-fluid container d-flex justify-content-center">
<div class="w-25 mt-4 container-lg">
{* {if $mostrarTodo} *}
    <h1 class="display-5">{$nombre_carrera}</h1>
{* {else} *}
    <h1 class="display-5">Materias</h1>
{* {/if}     *}
    <ul class="list-group">
        {foreach from=$materias item=$materia}
            <li class="list-group-item mb-4"><a href="detalle/{str_replace(' ', '-', $materia->nombre)|lower}/{$materia->id_materia}">{$materia->nombre}</a></li>
        {/foreach}
    </ul>
    </div>
</div>
<a href="carreras" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}