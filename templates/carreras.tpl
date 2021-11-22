{include file='templates/header.tpl'}



<a href="materias" class="m-3"><button type="button" class="btn btn-info">Ver materias</button></a>

 {if $isAdmin==true || $isAdmin==false} 
    <a href="tablacarreras" class="m-3"><button type="button" class="btn btn-info">Editar carreras</button></a>
    <a href="tablamaterias?nroPagina=1" class="m-3"><button type="button" class="btn btn-info">Editar materias</button></a>
{/if}  

 {if $isAdmin==true} 
    <a href="panel" class="m-3"><button type="button" class="btn btn-danger">Panel Admin</button></a>
 {/if} 
 {if $isLoggin==true} 
<a href="logout" class="m-3"><button type="button" class="btn btn-danger">Log Out</button></a>
{/if} 
   {if $isAdmin==true} 
    <a href="agregarcarrera" class="m-3"><button type="button" class="btn btn-info">Agregar carrera</button></a>
    <a href="agregarmateria" class="m-3"><button type="button" class="btn btn-info">Agregar materia</button></a>
  {/if}  

  {if  $isLoggin==false}  
    <a href="registro" class="m-3"><button type="button" class="btn btn-success">Registrarse</button></a>
    <a href="login" class="m-3"><button type="button" class="btn btn-warning">Iniciar sesion</button></a>
 {/if} 


<div class="container w-75 d-flex flex-wrap my-2 mb-3">
    {foreach from=$carreras item=$carrera}
        <div class="carrera mx-auto">
            <a href="carrera/{str_replace(' ', '-', $carrera->nombre)}/{$carrera->id_carrera}" >
                <p>{$carrera->nombre}</p>
            </a>
        </div>

    {/foreach}
</div>

{include file='templates/footer.tpl'}