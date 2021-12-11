{literal}
    <div id="app-comentarios">

    <table>
    <thead>
        <tr>
            <td>Hora</td>
            <td>Usuario</td>
            <td>Comentario</td>
            <td>Puntaje</td>
            <td>Borrar</td>
        </tr>
    </thead>


    <tr v-for="comentario in comentarios">
      <td>{{comentario.fecha}} </td>
      <td>{{comentario.nombre}}</td>
      <td>{{comentario.comentario}}</td>
      <td>{{comentario.puntaje}}</td>
      <td>{{comentario.id_comentario}}</id>
      <button v-on:click="borrarComentario(comentario.id)" v-if="admin==true">Borrar</button>

    </tr>

  
  </table>
  
</div>


{/literal}




