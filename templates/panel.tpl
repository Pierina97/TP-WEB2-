{include file='templates/header.tpl'}

<div class="container-fluid w-100 d-flex justify-content-center">
    <div>
        <h1>Modificar permisos</h1>


        <table class="my-4 table">
            <thead>
                <tr>
                    <th class="col">NOMBRE</th>
                    <th class="col">email</th>

                    <th class="col">Permisos</th>
                </tr>
            </thead>
            {foreach from=$users item=user}
                <tr style=text-align:center>
                    <td>{$user->nombre}</td>
                    <td>{$user->email}</td>


                    <form class="form-alta" action="modifyrol/{$user->id_usuario}" method="POST">

                        <td><input class="form-control" id="rol" name="rol" value="{$user->rol}"></td>

                        {if $isAdmin} <td> <button type="submit" class="btn btn-primary"> Editar </button></td>

                            <td><a class="btn btn-primary" id="borrar" href="borrarusuario/{$user->id_usuario}">borrar</a></td>
                        {/if}
                    </form>
                {/foreach}
                <p>{$aviso}</p>
            </tr>

        </table>

    </div>
</div>
<a href="carreras" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}