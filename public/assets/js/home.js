const supp = document.querySelectorAll('.addedP');
supp.forEach(cross => {
    cross.addEventListener('click', () => {
        const vignettes = document.querySelectorAll('.category');
        const text_del = document.querySelector('.supp-text')

        /* Removing viber mode and crosses */
        vignettes.forEach(vignette => {
            vignette.classList.remove('viber');
        });
        text_del.textContent = "Supprimer un Album";
        const supp = document.querySelectorAll('.addedP');
        supp.forEach(cross => {
            cross.style.display = 'none';
        })
        text_del.style.height = '';
        text_del.style.lineHeight = '';

        /* Generate confirmation modal */
        const modal = document.createElement('div');
        modal.classList.add('modal');
        modal.style.overflowY = 'auto';
        modal.style.zIndex = '10';
        modal.style.overscrollBehaviorY = 'contain';
        const para = document.createElement('p');
        para.classList.add('pConfirm')
        para.textContent = "Etes vous certain de vouloir Supprimer cet album ? Cette action est irréversible.";

        /* Modal confirmation button */
        const hidden = document.createElement('input')
        hidden.setAttribute('type', 'hidden');
        hidden.setAttribute('value', cross.id);
        hidden.setAttribute('name', 'catid');

        const confirm = document.createElement('input');
        confirm.setAttribute('type', 'submit');
        confirm.setAttribute('value', 'Confirmer');


        const form = document.createElement('form');
        form.setAttribute('method', 'POST');
        form.setAttribute('action', 'http://pictures.sytes.net/supp');
        form.append(hidden);
        form.append(confirm);

        /* Modal cancel button */
        const cancel = document.createElement('div');
        cancel.classList.add('cancel')
        cancel.textContent = 'Annuler';

        const divBoutons = document.createElement('div');
        divBoutons.classList.add('button-conf-supp');
        divBoutons.append(form);
        divBoutons.append(cancel);
        modal.append(para);
        modal.append(divBoutons)
        document.body.prepend(modal);

        /* Modal closing function */
        cancel.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    });
});
const crosses = document.querySelectorAll('.addedP');
const drop_container = document.querySelector('.categories');
const vignettes = document.querySelectorAll('.category');
const deleteButton = document.querySelector('.supp-album');
const text_del = document.querySelector('.supp-text');

/* Instructions on user interaction with delete album button */
deleteButton.addEventListener('click', () => {

    /* Crosses appearance management */
    crosses.forEach(cross => {
        if(cross.style.display === 'block'){
            cross.style.display = 'none';
        } else {
            cross.style.display = 'block';
        }
    })
    /* toggling viber mode */
    vignettes.forEach(cat => {
        cat.classList.toggle('viber');
    });
    /* Button text content managment */
    if(text_del.textContent === "Terminé"){
        text_del.textContent = "Supprimer un Album";
        text_del.style.height = '';
        text_del.style.lineHeight = '';
    } else{
        text_del.textContent = "Terminé";
        text_del.style.height = '37px';
        text_del.style.lineHeight = '37px';
    }
})
/*
let dragIndex;
function dragStart() {
    this.classList.add('draggable');
    dragIndex = +this.closest('div').getAttribute('data-index');
    console.log(dragIndex)
}
function dragEnd() {
    this.classList.remove('draggable');
}
function dragOver(e) {
    e.preventDefault();
}
function drop() {
    const dragEndIndex = +this.getAttribute('data-index');
    console.log(dragEndIndex);
    swapElements(dragIndex, dragEndIndex);
    sort();
}

function swapElements(from, to) {
    const allElements = document.querySelectorAll('.addedCat');
    allElements[from - 1].parentNode.insertBefore(allElements[from - 1], allElements[to - 1]);
}

function sort()
{
    let count = 1;
    const allElements = document.querySelectorAll('.addedCat');
    allElements.forEach(e => {
        e.dataset.index = count++
    })
}

const draggable = document.querySelectorAll('.addedCat');
draggable.forEach(element => {
    element.addEventListener('dragstart', dragStart);
    element.addEventListener('dragend', dragEnd);
    element.addEventListener('dragover', dragOver)
    element.addEventListener('drop', drop);
})
*/

