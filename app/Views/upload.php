
<div class="container">
    <h4 class="title">Video upload</h4>
    <div class="back">
        <a href="<?= base_url('/')?>" class="back-link">
            <div class="retour"><span id="span"></span></div>
        </a>
    </div>
    <form method="post" action="<?php echo base_url('upload'); ?>" enctype="multipart/form-data" class="form-data">
        <div class="upload-elements file-input">
            <p class="format">(mp4, mov)</p>
            <p class="infos">~2mn pour un temps de chargement acceptable</p>
            <label for="file" class="label-file">Choisir une vidéo</label>
            <input id="file" type="file" name="file" class="input-file" onchange="processFile(this, input_video_display)">
        </div>
        <div class="uploaded-video"></div>
        <div class="upload-elements description">
            <label for="desc">Description Courte</label>
            <input type="text" name="desc">
        </div>
        <div class="select-cat">
            <label for="cat-select">Album:</label>
            <select name="cat" id="cat-select">
                <option value="">--Choix de la l'album--</option>
            </select>
        </div>
        <div class="upload-elements img-input">
            <p class="format">(png, jpg, jpeg)</p>
            <p class="infos">De préférence en format paysage et légère</p>
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
            <button type="submit" class="btn">Upload</button>
        </div>
    </form>
    <div class="cross">✖️</div>
    <?= $response ?>
</div>
<script>
    const dataArray = [];
    <?php foreach ($dataCat as $element){?>
    dataArray.push(['<?= $element[0]?>', '<?= $element[1]?>', '<?= $element[2]?>'])
    <?php }?>
    console.log(dataArray)
    const select = document.querySelector('#cat-select');
    dataArray.forEach(cat => {
        const option = document.createElement('option');
        option.setAttribute('value', cat[0]);
        option.textContent = cat[0];
        select.append(option);
    })
</script>
