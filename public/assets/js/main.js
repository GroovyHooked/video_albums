const photo = document.querySelectorAll('.photo');
const modal = document.querySelector('.modal')
const img = document.querySelector('#imgdisplay')
const flecheg = document.querySelector('.flecheg');
const fleched = document.querySelector('.fleched');
const close = document.querySelector('.close')
const fleche_retour = document.querySelector('.fleche_retour')
const container = document.querySelector('.container')
const controls = document.querySelector('.controls')
const base_url = 'http://pictures.sytes.net';


const imgSources = []
photo.forEach(e => {
    imgSources.push(e.dataset.value)
})

photo.forEach(element => {
    element.addEventListener('click', () => {
        modal.style.display = 'flex'
        container.style.margin = 0
        fleche_retour.style.display = 'none'
        element.classList.add('seen')
        img.src = base_url + element.dataset.value
        console.log(element.dataset.value)
        img.dataset.index = element.dataset.index

        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera

        document.querySelectorAll('.photo').forEach(e => {
            e.classList.add('hidden')
        })

    })
})

fleched.addEventListener('click', () => {
    let index = img.dataset.index
    index++
    if(imgSources[index + 1]){
        img.dataset.index = index
        img.src = base_url + imgSources[index]
    }
})
flecheg.addEventListener('click', () => {
    let index = img.dataset.index
    index--
    if(imgSources[index - 1]){
        img.dataset.index = index
        img.src = base_url + imgSources[index]
    }
})



close.addEventListener('click', () => {
    modal.style.display = 'none'
    fleche_retour.style.display = 'block'
    container.style.margin = ''
    document.querySelector('.seen').classList.remove('seen')
    document.querySelectorAll('.photo:not(.seen)').forEach(e => {
        e.classList.remove('hidden')
    })
})
let x = window.matchMedia("(min-width: 600px)")
if(x.matches){
    modal.prepend(controls)
}