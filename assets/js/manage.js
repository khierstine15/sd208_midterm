const addActivity = document.getElementById("activityModal"),
    editActivity = document.getElementById("editModal"),
    showActivity = document.getElementById("showModal"),
    setActivity = document.getElementById("setModal");

const btns = document.querySelectorAll('button');
const modals = document.querySelectorAll(".modal");

// For Close the modal
function closeModal() {
    modals.forEach(modal => {
        modal.style.display = "none";
    });
}

modals.forEach(modal => {
    modal.addEventListener('click', function (event) {
        if (event.target.classList.contains('close')) {
            closeModal();
        }
    });
});

window.onclick = function (event) {
    if (event.target.classList.contains('modal')) {
        closeModal();
    }
};



// For Buttons
btns.forEach(btn => {

    btn.addEventListener('click', function () {
        if (btn.id === 'addActivityBtn') {
            addActivity.style.display = 'block';

        }
        else if (btn.id === 'editBtn') {
            editActivity.style.display = 'block';


        }

        else if (btn.id === 'showActivities') {
            showActivity.style.display = 'block';

        }
        else if (btn.id === 'setBtn') {
            setActivity.style.display = 'block';

        }
    })


});

