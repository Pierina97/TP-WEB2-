
{include file='templates/header.tpl'}
<div class = "container w-75 d-flex justify-content-center">
  <div class="m-3 w-25 container-registro">
    <h2>SIGN UP</h2>
  
    <form method="POST"  action="signup">
        <div class="col-auto mb-2">
          <label for="email-registration" class="form-label">Email</label>
          {if !isset($errorXcampo["emailError"]) }
            <input type="text" class="form-control" name="email" id="email-registration" {if isset($errorXcampo['email'])} value="{$errorXcampo['email']}" {else} placeholder="email@example.com"{/if}>
          {else}
            <input type="text" class="form-control is-invalid" name="email" id="email-registration" placeholder="email@example.com">
            <div class="invalid-feedback">{$errorXcampo['emailError']}</div>
          {/if}
        </div>
  
        <div class="col-auto mb-2">
          <label for="name-registration" class="form-label">Nombre</label>
          {if !isset($errorXcampo["nombreError"]) }
          <input type="text" class="form-control" name="nombre" id="name-registration" {if isset($errorXcampo['nombre'])} value="{$errorXcampo['nombre']}" {else} placeholder="Nombre..."{/if}>
          {else}
            <input type="text" class="form-control is-invalid" name="nombre" id="name-registration"placeholder="nombre">
            <div class="invalid-feedback">{$errorXcampo['nombreError']}</div>
          {/if}
        </div>
  
        <div class="col-auto mb-2">
            <label for="password-registration" placeholder="password" class="form-label">contraseña</label>
            {if !isset($errorXcampo["passwordError"]) }
              <input type="password" class="form-control" name="password" id = "password-registration" {if isset($errorXcampo['password'])} value="{$errorXcampo['password']}" {else} placeholder="password"{/if}>
            {else}
              <input type="password" class="form-control is-invalid" name="password" id = "password-registration" placeholder="password">
              <div class="invalid-feedback">{$errorXcampo['passwordError']}</div>
            {/if}
        </div>
  
      <button type="submit" class="btn btn-primary">Submit</button>
  
    </form>
    {if $error}
      <p class="lead">{$error}</p>
    {/if}
  </div>
</div>

<a href="carreras" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}