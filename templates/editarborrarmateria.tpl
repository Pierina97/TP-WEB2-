{include file="templates/header.tpl"}

<div class="container-fluid w-100 d-flex justify-content-center">
  <div>
    {* {if $idAdmin=="true"} *}
     <h1> EDITAR Y BORRAR MATERIAS</h1> 
    {* {/if} *}
    <table class="my-4 table">
       <thead>

         <tr>

         
          <th class="col">MATERIA</th> 
          <th class="col">PROFESOR</th>
          <th class="col">DURACION</th>
           {* {if $rol=="true"} *}
            <th class="col">borrar</th>
            <th class="col">editar</th>
         {*  {/if} *}


         </tr>

         </thead>

       
       {foreach from=$tablaMaterias item=item}
        <form class="form-alta" action="editarmateria/{$item->id_materia}" method="POST"> 
                   <tr style=text-align:center>
          
            <td><input class="form-control" type="text" name="nombre" value="{$item->nombre}"></td>
            <td><input class="form-control" type="text" name="profesor" value="{$item->profesor}"></td>
            <td><input class="form-control" type="number" name="id_carrera" value="{$item->id_carrera}"></td>
        {* {if $rol=="true"} *}
              <td><a class="btn btn-primary" href="borrarmateria/{$item->id_materia}">borrar</a></td>
              <td><button type="submit" class="btn btn-primary">editar</button></td>   
            {* {/if} *}
             </tr> 
         </form>
           
     {/foreach}
   
    </table>

  </div>
</div>
<a href="carreras" class="volver">VOLVER</a>
{include file="templates/footer.tpl"}
