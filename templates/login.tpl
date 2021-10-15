{include file='templates/header.tpl'}

<div class = "container w-75 d-flex justify-content-center">
    <div class="m-3 w-25">
        <form action="verify" class="my-2  form-group" method="POST">
            <div class="col-auto mb-2">
                {if !isset($errorXcampo["emailError"]) }
                  <input type="text" class="form-control" name="email" {if isset($errorXcampo['email'])} value="{$errorXcampo['email']}" {else} placeholder="email@example.com"{/if}>
                {else}
                  <input type="text" class="form-control is-invalid" name="email" placeholder="email@example.com">
                  <div class="invalid-feedback">{$errorXcampo['emailError']}</div>
                {/if}
            </div>

            <div class="col-auto mb-2">
              {if !isset($errorXcampo["passwordError"]) }
                <input type="password" class="form-control" name="password" {if isset($errorXcampo['password'])} value="{$errorXcampo['password']}" {else} placeholder="password"{/if}>
              {else}
                <input type="password" class="form-control is-invalid" name="password" placeholder="password">
                <div class="invalid-feedback">{$errorXcampo['passwordError']}</div>
              {/if}
            </div>

            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-3">Confirmar identidad</button>
            </div>
        </form>
        {if $error}
          <p class="lead">{$error}</p>
        {/if}
    </div>
</div>
<a href="carreras" class="volver">VOLVER</a>
{include file='templates/footer.tpl'}