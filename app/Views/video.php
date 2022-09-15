<script>
    const video_data = {}
    video_data.path = []
    video_data.name = []
    video_data.thumbs_path = []
    <?php foreach ($bdd as $value){?>
    video_data.path.push('<?= base_url($value->path) ?>')
    video_data.name.push('<?= $value->description?>')
    video_data.thumbs_path.push('<?= base_url($value->thumb) ?>')
    <?php
    }?>
</script>

<div class="container-video">
    <?php if(empty($bdd)){
        echo '<div class="alert">';
        echo '<p> Aucune vidéo téléversée.</p>';
        echo '<p> Vous pouvez en ajouter en cliquant sur ce lien:</p>';
        echo '<a href='.'"'. base_url('upload').'"'.'>Upload</a>';
        echo '</div>';
    } ?>
    <div class="title-section">
        <div>
            <a href="<?= base_url('/')?>" class="back-link">
                <div class="retour"><span id="span"></span></div>
            </a>
        </div>
        <h3 class="video-h3"></h3>
    </div>
    <div class="selection">
    </div>
    <div class="control-div drop-zone">
        <div class="controls" draggable="true">
            <div class="control rewind"></div>
            <div class="control play"></div>
            <div class="control pause"></div>
            <div class="control forward"></div>
            <div class="control full-screen"></div>
            <div class="rotate"></div>
        </div>
    </div>
    <div class="progression-bar"><span class="dot" draggable="true">●</span></div>
    <div class="video-container_parent">
        <div class="container-drop-zone left-side"></div>
        <div class="video-container">
            <video class="video video1" playsinline>
                <source src="" type="video/mp4" class="video-source">
            </video>
        </div>
        <div class="selection2">
            <div class="video-list">
                <div class="video-list-enfant"></div>
            </div>
        </div>
        <div class="container-drop-zone right-side"></div>
    </div>
    <div class="drop-zone">

    </div>
</div>
<?php if(empty($bdd)){ ?>
<script>
    const title = document.querySelector('.title-section');
    const control_div = document.querySelector('.control-div');
    const progression = document.querySelector('.progression-bar');
    const video_container = document.querySelector('.video-container_parent');
    //title.style.display = 'none';
    control_div.style.display = 'none';
    progression.style.display = 'none';
    video_container.style.display = 'none';
</script>
<?php } ?>