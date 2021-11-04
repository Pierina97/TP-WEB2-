{include file='templates/header.tpl'}
                               {* AGREGAR CARRERA *}
<div class="container d-flex justify-content-center">
    <div class="m-3 w-25">
        <h2>AGREGAR CARRERA</h2>
        <form class="form-alta" action="agregar-carrera" method="post"> 
            <div class="col-auto mb-2">
                <input class="form-control" placeholder="Nombre.." type="text" name="nombre" id="nombre" >
            </div>
            <div class="col-auto mb-2">
                <input class="form-control" placeholder="Duracion.." type="text" name="duracion" id="duracion" >
            </div>
        {if $isAdmin} 
        <input type="submit" class="btn btn-primary">
    {/if}
        </form>
        {* <p>{$aviso}</p> *}
    </div>
</div>
<p>{$aviso}</p>
<a href="carreras" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}