(function sliderOpacityAuto () {
    // elements dom
    var newSlider  = document.querySelector('.new-slider');
    var figureList = document.querySelectorAll('.new-slider figure');
    var buttonNext = document.querySelectorAll('.arrow-new');

    var figureLastIndex = figureList.length - 1;
    var arrowIndex = 0;

    setInterval(() => {
        for(var i = 0 ; i < figureList.length; i++) {
            figureList[i].classList.add('out');
        }

        if (arrowIndex == figureLastIndex) {
            arrowIndex = 0;
        } else {
            arrowIndex++;
        }

        for(var i = 0 ; i < buttonNext.length; i++) {
            buttonNext[i].setAttribute('data-index', arrowIndex);
        }

        figureList[arrowIndex].classList.remove('out');
    }, 5000)
})();

function sliderOpacity(elemnt){
    // elements dom
    var newSlider  = document.querySelector('.new-slider');
    var figureList = document.querySelectorAll('.new-slider figure');

    // datas
    var direccion  = elemnt.dataset.direccion;
    var arrowIndex = parseInt(elemnt.dataset.index);

    var figureLastIndex = figureList.length - 1;

    for(var i = 0 ; i < figureList.length; i++) {
        figureList[i].classList.add('out');
    }

    if (direccion == 'right') {
        if (arrowIndex == figureLastIndex) {
            arrowIndex = 0;
        } else {
            arrowIndex++;
        }

        elemnt.setAttribute('data-index', arrowIndex);
    }

    if (direccion == 'left') {
        if (arrowIndex == 0) {
            arrowIndex = figureLastIndex;
        } else {
            arrowIndex--;
        }
        elemnt.setAttribute('data-index', arrowIndex);
    }

    // setear index ambos botones
    var buttonNext = document.querySelectorAll('.arrow-new');
    for(var i = 0 ; i < buttonNext.length; i++) {
        buttonNext[i].setAttribute('data-index', arrowIndex);
    }

    figureList[arrowIndex].classList.remove('out');
}