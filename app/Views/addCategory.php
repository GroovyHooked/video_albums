<div class="container">
    <h4 class="title">Ajout d'Album</h4>
    <div class="back">
        <a href="<?= base_url('/')?>" class="back-link">
            <div class="retour"><span id="span"></span></div>
        </a>
    </div>
    <form method="post" action="<?php echo base_url('category'); ?>" enctype="multipart/form-data" class="form-data">
        <div class="upload-elements description">
            <label for="desc">Nom de l'album</label>
            <input type="text" name="desc">
        </div>
        <div class="upload-elements img-input">
            <p class="format formatAdd">(png, jpg, jpeg)</p>
            <p class="infos formatAdd">De préférence en format paysage et légère. Elle sera utilisée comme vignette sur la page d'accueil</p>
            <label for="img" class="label-file">Choisir une image</label>
            <input id="img" type="file" name="img" class="input-file" onchange="processFile(this, input_img_display)">
        </div>
        <div class="uploaded-img"></div>
        <div class="wait">
            <span class="rond1 loader1"></span>
            <p>Chargement en cours</p>
            <p>Ne quittez pas cette page</p>
        </div>
        <div class="upload-elements submit">
            <button type="submit" class="btn">Ajouter</button>
        </div>
    </form>
    <div class="cross">✖️</div>
    <?= $response ?>
</div>
