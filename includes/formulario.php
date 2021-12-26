<main>
  <section>
    <a href="index.php">
      <button class="btn btn-success">Voltar</button>
    </a>
  </section>

  <h2 class="mt-1"><?=TITLE?></h2>

  <form method="post">
    <div class="form-group">
      <label for="titulo">Título</label>
      <input type="text" class="form-control" name="titulo" value="<?= $obVaga->titulo?>">
    </div>

    <div class="form-group">
      <label for="descricao">Descrição</label>
      <textarea name="descricao" id="descricao" class="form-control" rows="5"><?= $obVaga->descricao?></textarea>
    </div>

    <div class="form-group">
      <label for="titulo">Status</label>

      <div>

        <div class="form-check form-check-inline">
          <label class="form-control">
            <input type="radio" name="ativo" value="s" checked> Ativo
          </label>
        </div>

        <div class="form-check form-check-inline">
          <label class="form-control">
            <input type="radio" name="ativo" value="n" <?= $obVaga->ativo == 'n' ? 'checked' : '' ?>> Inativo
          </label>
        </div>

      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-success">Enviar</button>
      </div>

    </div>

  </form>
</main>