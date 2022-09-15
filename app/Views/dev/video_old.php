<script>
    const video_data = {}
    video_data.path = []
    video_data.name = []
    video_data.thumbs_path = []
    <?php foreach ($bdd as $value){?>
    video_data.path.push('<?= base_url($value->path) ?>')
    video_data.name.push('<?= $value->description?>')
    if(video_data.thumbs_path !== null){
        video_data.thumbs_path.push('<?= base_url($value->thumb) ?>')
    }
    <?php }?>
</script>
<div class="container-video">
    <?php if(empty($bdd)){
        echo '<div class="alert">';
        echo '<p> Aucune vidéo téléversée.</p>';
        echo '<p> Vous pouvez en ajouter en cliquant sur ce lien:</p>';
        echo '<a href='.'"'. base_url('upload').'"'.'>Uploads</a>';
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
    <div class="drop-zone">
        <div class="controls" draggable="true">
            <div class="control rewind"></div>
            <div class="control play"></div>
            <div class="control pause"></div>
            <div class="control forward"></div>
            <div class="control full-screen"></div>
        </div>
    </div>

    <div class="progression-bar"><span class="dot" draggable="true">●</span></div>
    <div class="video-container_parent">
        <div class="container-drop-zone"></div>
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
        <div class="container-drop-zone"></div>
    </div>
    <div class="drop-zone">
    <pre>

    </pre>
    </div>
</div>
