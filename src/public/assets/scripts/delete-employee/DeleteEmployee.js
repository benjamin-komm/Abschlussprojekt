let element = document.querySelector('.container > form');

if (element !== null) {
    element.addEventListener('submit', () => {
        document.getElementsByName('delete_confirm')[0].value = "true";
    });
}