
const video = document.querySelector('.video');
const video_source = document.querySelector('.video-source');
let title = document.querySelector('.video-h3');
const rewind = document.querySelector('.rewind');
const play = document.querySelector('.play');
const pause = document.querySelector('.pause');
const forward = document.querySelector('.forward');
const full_screen = document.querySelector('.full-screen');
const dot = document.querySelector('.dot');
const controls = document.querySelector('.controls');
const drop_zone = document.querySelectorAll('.drop-zone');
const container_drop_zone = document.querySelectorAll('.container-drop-zone');
const list_parent = document.querySelector('.video-list');
const list = document.querySelector('.video-list-enfant');
const selection = document.querySelector('.selection');
const selection2 = document.querySelector('.selection2');
const rotate = document.querySelector('.rotate');
const drop_left = document.querySelector('.left-side');

const angle = ['0deg', '270deg', '180deg', '90deg']
let count = angle.length;
console.log(count - 1)
rotate.addEventListener('click', () => {
    if (count > 0){
        video.style.rotate = angle[count - 1]
        console.log(video.style.rotate)
        if(video.style.rotate === '90deg' || video.style.rotate === '270deg'){
            selection2.style.position = 'relative';
            selection2.style.right = '-147px';
        } else {
            selection2.style.position = '';
            selection2.style.right = '';
        }
        count--
    } else {
        console.log('else');
        count = angle.length;
        video.style.rotate = '90deg';
        selection2.style.position = 'relative';
        selection2.style.right = '-147px';
    }
})

/* generate thumbnails  */
for(let i = 0; i <= video_data.path.length - 1; i++){
    let div = document.createElement('div');
    let title = document.createElement('p');
    title.textContent = video_data.name[i];

    let img = document.createElement('img');
    img.classList.add('video-vignette');
    img.src = video_data.thumbs_path[i];
    img.setAttribute('loading', 'lazy');
    div.append(title);
    div.append(img);
    div.classList.add('vignette');
    div.id = i;
    list.append(div);
}

/* Change the source when user interact */
document.addEventListener('DOMContentLoaded', function() {
    const vignettes = document.querySelectorAll('.vignette');
    //console.log(vignettes);
    vignettes.forEach(e => {
        e.addEventListener('click', () => {
            let index = e.id;
            video_source.src = video_data.path[index];
            title.textContent = video_data.name[index];
            video.load();
        })
    })
});

/* Feed the source ans the title of the first displayed video*/
video_source.src = video_data.path[0]
title.textContent = video_data.name[0];

/* Firing the video */
video.load()

/* ==========   Control section ==============*/
play.addEventListener('click', () => {
    video.play();
})
pause.addEventListener('click', () => {
    video.pause();
    clearInterval(start_progression);
})
rewind.addEventListener('click', () => {
    video.currentTime -= 3;
    progression();
})
forward.addEventListener('click', () => {
    video.currentTime += 3;
    progression();
})
full_screen.addEventListener('click', () => {
    if (video.webkitEnterFullScreen)  video.webkitEnterFullscreen();
    if (video.requestFullscreen)  video.requestFullscreen();
    if (video.msRequestFullscreen)  video.msRequestFullscreen();
})
/* =========================================*/

/* progression bar function */
const progression = () => {
    let index;
    index = video.currentTime * 100 / video.duration;
    let width = index - 50;
    dot.style.left = width + '%';
}
/* Progression bar initialization */
let start_progression
video.onplay = () => {
    start_progression = setInterval(progression, 100);

}
/* ======  Drag and drop on control bar =========== */
controls.addEventListener('dragstart', (e) => {
    controls.classList.add('draggable');
    drop_zone.forEach(e => {
        e.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
    })
    container_drop_zone.forEach(e => {
        e.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
    })
})
controls.addEventListener('dragend', (e) => {
    controls.classList.remove('draggable');
    drop_zone.forEach(e => {
        e.style.backgroundColor = '';
    })
    container_drop_zone.forEach(e => {
        e.style.backgroundColor = '';
    })
})
/* =========================================*/

/* ==== Media query for drag and drop and control bar positioning ===== */
let x = window.matchMedia("(max-width: 900px)");
if(x.matches){
    selection.appendChild(list_parent);
    drop_zone.forEach( zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            const draggable = document.querySelector('.draggable');
            //drop_left.style.left = '0px';
            rotate.style.right = '-58px';
            draggable.style.height = '45px';
            draggable.style.width = '300px';
            draggable.style.flexDirection = 'row';
            zone.appendChild(draggable);
        })
    })
    container_drop_zone.forEach( zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            const draggable = document.querySelector('.draggable');
            //drop_left.style.left = '0px';
            rotate.style.right = '-58px';
            draggable.style.height = '300px';
            draggable.style.width = '45px';
            draggable.style.flexDirection = 'column';
            zone.appendChild(draggable);
        })
    })
} else {
    selection2.appendChild(list_parent);
    drop_zone.forEach( zone => {
        zone.addEventListener('dragover', (e) => {
            console.log('test1');
            e.preventDefault();
            const draggable = document.querySelector('.draggable');
            //drop_left.style.left = '0px';
            rotate.style.right = '-58px';
            draggable.style.height = '70px';
            draggable.style.width = '400px';
            draggable.style.flexDirection = 'row';
            zone.appendChild(draggable);
        })
    })
    container_drop_zone.forEach( zone => {
        zone.addEventListener('dragover', (e) => {
            rotate.style.right = '-58px';
            //drop_left.style.left = '0px';
            if(zone.classList.contains('left-side')){
                rotate.style.right = '74px';
                //drop_left.style.left = '-148px';
            }

            console.log('test2');
            e.preventDefault();
            const draggable = document.querySelector('.draggable');
            draggable.style.height = '400px';
            draggable.style.width = '70px';
            draggable.style.flexDirection = 'column';
            zone.appendChild(draggable);
        })
    })
}
/* =========================================*/
