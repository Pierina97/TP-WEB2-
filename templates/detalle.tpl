{include file="templates/header.tpl"}

<div class="container mt-2">

    <ul class="list-group">
        <li class="list-group-item mb-3">Materia | {$materia->nombre}</li>
        <li class="list-group-item">Profesor | {$materia->profesor}</li>
    </ul>
</div>
  <a href="carrera" class="volver">VOLVER</a>  
{include file="templates/footer.tpl"}