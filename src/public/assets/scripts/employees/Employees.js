document.querySelector('.table_filter_job').addEventListener('change', () => {
    applyFilters();
});

document.querySelector(".table_filter_firstname").addEventListener('keyup', () => {
    applyFilters();
});

document.querySelector(".table_filter_lastname").addEventListener("keyup", () => {
    applyFilters();
});

function applyFilters() {
    let firstnameFilter = document.querySelector(".table_filter_firstname").value.toLowerCase(),
        lastnameFilter = document.querySelector(".table_filter_lastname").value.toLowerCase(),
        jobFilter = document.querySelector(".table_filter_job").selectedOptions[0].value,
        elements = document.querySelectorAll('.table_entry');

    for (let element of elements) {
        let firstnameElement = element.querySelector(".table_entry_firstname"),
            lastnameElement = element.querySelector(".table_entry_lastname");
        if (firstnameElement.innerHTML.toLowerCase().indexOf(firstnameFilter) !== -1 &&
            lastnameElement.innerHTML.toLowerCase().indexOf(lastnameFilter) !== -1 &&
            matchJobFilter(jobFilter, element.dataset.jobId)) {
            element.style.display = "flex";
        } else {
            element.style.display = "none";
        }
    }
}

function matchJobFilter(filterValue, elementValue) {
    if (parseInt(filterValue) === 0) {
        return true;
    } else {
        if (elementValue !== filterValue) {
            return false;
        } else {
            return true;
        }
    }
}