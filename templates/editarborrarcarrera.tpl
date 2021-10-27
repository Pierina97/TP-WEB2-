{include file="templates/header.tpl"}

<div class="container-fluid w-100 d-flex justify-content-center">
      <div>
            <h1> EDITAR Y BORRAR CARRERAS</h1> 
            <table class="my-4 table">
               <thead>

                 <tr>
                    <th class="col">Carrera</th> 
                    <th class="col">Duracion</th>
                  {* {if $smarty.session.rol == "admin"} *}
                    <th class="col" > BORRAR</th>  
                    <th class="col">EDITAR</th>
                    {* {/if} *}


                 </tr>

                </thead>

  <p class="lead">{$aviso}</p>
               {foreach from=$tablaCarreras item=item}
                <form class="form-alta" action="editarcarrera/{$item->id_carrera}" method="POST"> 

                      <tr>
                        <td><input class="form-control" type="text" name="nombre" value="{$item->nombre}"></td>
                        <td><input class="form-control" type="number" name="duracion" value="{$item->duracion}"></td>
               {* {if $smarty.session.rol == "admin"} *}
                              <td><a class="btn btn-primary" id="borrar" href="borrarcarrera/{$item->id_carrera}">borrar</a></td>
                              <td><button type="submit" class="btn btn-primary">editar</button></td>    
                        {* {/if}    *}
                </form>
                     </tr>
             {/foreach}
            </table>
      </div>
   
</div>         
       
<a href="carreras" class="volver">VOLVER</a>

{include file="templates/footer.tpl"}

         