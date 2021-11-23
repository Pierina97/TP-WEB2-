{include file="templates/header.tpl"}

<div class="container-fluid w-100 d-flex justify-content-center">
    <div>
        <h1> EDITAR Y BORRAR MATERIAS</h1>
        <table class="my-4 table">
            <thead>
                <tr>
                    <th class="col">MATERIA</th>
                    <th class="col">PROFESOR</th>
                    <th class="col">Carrera</th>
                    {if $isAdmin}
                        <th class="col">borrar</th>
                        <th class="col">editar</th>
                    {/if}
                </tr>
            </thead>

            {foreach from=$tablaMaterias  item=item}

                <form class="form-alta" action="editarmateria/{$item->id_materia}" method="POST">
                    <tr style=text-align:center>

                        <td><input class="form-control" type="text" name="nombre" value="{$item->nombre}"></td>
                        <td><input class="form-control" type="text" name="profesor" value="{$item->profesor}"></td>
                        <td><input class="form-control" type="text" name="id_carrera" readonly
                                value="{$item->nombre_carrera}"></td>
                        {if $isAdmin}
                            <td><a class="btn btn-primary" href="borrarmateria/{$item->id_materia}">borrar</a></td>
                            <td><button type="submit" class="btn btn-primary">editar</button></td>
                        {/if}
                    </tr>
                </form>
            {/foreach}
        </table>

        <div class="contenedor-paginacion">
            <ul class="paginacion">


                {if $nroPagina>1}
                    <li><a href="tablamaterias?nroPagina={$nroPagina-1}" class="pagina-link">

                            <ion-icon name="chevron-back-outline"></ion-icon>
                        </a></li>
                {/if}
                {if $nroPagina< $nroPagMax}
                    <li><a href="tablamaterias?nroPagina={$nroPagina+1}" class="pagina-link">

                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </a></li>

                </ul>
            {/if}
        </div>

    </div>
</div>
<form action="tablamaterias?nroPagina={$nroPagina}" method="GET" id="formulario-filtro" class="form-alta">
    <div class="form-group">
        <label>Materia</label>
        <input type="text" name="materia-filtro">
    </div>
    <div class="form-group">
        <label>Profesor</label>
        <input type="text" name="profesor-filtro">
        <div class="form-group">
            <label>Carrera</label>
            <input type="text" name="carrera-filtro">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>

</form>
<a href="tablamaterias?nroPagina={$nroPagina}" class="btn btn-primary">Deshacer filtro</a>




<a href="carreras" class="btn btn-primary">VOLVER</a>

{include file="templates/footer.tpl"}