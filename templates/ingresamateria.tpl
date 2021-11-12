{include file='templates/header.tpl'}
<div class="container d-flex justify-content-center">
    <div class="m-3 w-25">
        <h2>AGREGAR MATERIA</h2>
        <form class="form-alta" action="agregar-materia" method="POST" enctype="multipart/form-data">
            <div class="col-auto mb-2">
                <input placeholder="nombre" type="text" name="nombre" id="nombre">
            </div>
            <div class="col-auto mb-2">
                <input placeholder="profesor" type="text" name="profesor" id="profesor">
            </div>
            <select class="custom-select mb-2 col-7" name="id_carrera">
                {foreach $carreras as $carrera}
                    <option value="{$carrera->id_carrera}">{$carrera->nombre}</option>
                {/foreach}
            </select>
            <br>
            <input type="file" name="imagen" id="imageToUpload">

            {if $isAdmin}
                <input type="submit" class="btn btn-primary">
            {/if}
        </form>
    </div>
    <p>{$aviso}</p>

     {* <div class="imagen">
        <form action="cargarimagen" method="POST" enctype="multipart/form-data"> 
            <input type="file" name="imagen" id="imageToUpload">
            <input type="submit" valu="Enviar Imagen">
        </form>
    </div> *}

</div>
<a href="carreras" class="volver">VOLVER</a>
{include file="templates/footer.tpl"}