<div class="container-home">
    <div>
        <h2>Albums Vidéos</h2>
        <div class="features">
            <a href="<?= base_url('category')?>" class="upload-link">
                <div class="ajout">
                    <p>Créer un Album Vidéo</p>
                </div>
            </a>
            <a href="<?= base_url('upload')?>" class="upload-link">
                <div class="ajout">
                    <p>Uploader une vidéo</p>
                </div>
            </a>
            <div class="upload-link supp-album">
                <div class="ajout">
                    <p class="supp-text">Supprimer un Album</p>
                </div>
            </div>
        </div>
    </div>

    <div class="categories">
        <div class="category category4">
            <h4>Toutes les vidéos</h4>
            <a href="<?= base_url('video3') ?>" id="link4">
                <div class="img img4"></div>
            </a>
        </div>
    </div>
</div>
<script>
    const dataArray = [];
    const id = 0;
    <?php foreach ($data as $element){?>
    dataArray.push(['<?= $element[0]?>', '<?= $element[1]?>', '<?= $element[2]?>'])
    <?php }?>
    if(dataArray.length > 0){
        let counter = 1;
        dataArray.forEach(e => {
            const p = document.createElement('p');
            p.id = e[2];
            p.textContent = '✖︎';
            p.classList.add('addedP');
            const img = document.createElement('img');
            img.classList.add('img')
            img.src = e[1];
            const link = document.createElement('a');
            link.href = "<?= base_url('cat')?>" +'/'+ e[2];
            link.append(img);
            const title = document.createElement('h4');
            title.textContent = e[0];
            const finalDiv = document.createElement('div');
            finalDiv.classList.add('category');
            finalDiv.classList.add('addedCat');
            finalDiv.setAttribute('draggable', 'true');
            finalDiv.setAttribute('data-index', counter++);
            finalDiv.append(p);
            finalDiv.append(title);
            finalDiv.append(link);
            document.querySelector('.categories').append(finalDiv);
        })
    }
</script>








