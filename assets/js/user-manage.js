const addActivity = document.getElementById("activityModal");
const editActivity = document.getElementById("editModal");
const showActivity = document.getElementById("showModal");
const setActivity = document.getElementById("setModal");

const btns = document.querySelectorAll("button");
const modals = document.querySelectorAll(".modal");

console.log(modals);
console.log(btns);

function closeModal(modal) {
  if (modal) {
    modal.style.display = "none";
  }
}

modals.forEach((modal) => {
  modal.addEventListener("click", function (event) {
    if (
      event.target.classList.contains("close") ||
      event.target.classList.contains("times")
    ) {
      closeModal(modal);
      event.stopPropagation(); 
    }
  });
});

window.addEventListener("click", function (event) {
  if (event.target.classList.contains("modal")) {
    closeModal(event.target);
  }
});

// For Buttons
btns.forEach((btn) => {
  btn.addEventListener("click", function () {
    if (btn.id === "addActivityBtn") {
      addActivity.style.display = "block";
    } else if (btn.id === "showActivities") {
      showActivity.style.display = "block";
    } else if (btn.id === "setBtn") {
      setActivity.style.display = "block";
    }
  });
});



