/**document.querySelector('.filter_job').addEventListener('change', () => {
    let selectedOption = document.querySelector('.filter_job').selectedOptions[0];
    let elements = document.querySelectorAll('.list_container > div');
    for (let element of elements) {
        if (element.dataset.jobId !== selectedOption.value){
            element.style.display = "none";
        }else {
            
        }
    }
});*/