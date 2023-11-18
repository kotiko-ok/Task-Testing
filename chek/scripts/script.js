add = document.querySelector("#add")
modal = document.querySelector("#modal")
submit = document.querySelector("#submit")
closer = document.querySelector("#close")
projects = document.querySelector(".projects")
search = document.querySelector("#search")

function closeModal(){
    modal.classList.add("hide")
}
function openModal(){
    modal.classList.remove("hide")
}

function setChekLists(){
    let id  = 1
    let title = $("#title").val()
    let dis = $("#description").val()
    data = {"id_creator":id,
            "name":title,
            "description":dis
        }

    $.ajax({
        type: "POST",
        url: "/php/save_list.php",
        data: data,
        success: function(response){
            location.reload()
        //     projects.innerHTML = 
        //     `  <div class="project">
        //     <div class="project__block project__blockdis">

        //         <div class="project__title"><a href="task?n=${response}">${title}</a></div>
        //         <div class="project__discryption">${dis}</div>

        //     </div>

        //     <div class="project__block">

        //         <div class="project__status status" title="Не пройден">

        //         </div>
        //         <div class="project__menu">
        //             <image class="menu__item" src="images/3ots.svg" alt="..."></image>
        //         </div>

        //     </div>

        // </div>`+projects.innerHTML

            
            console.log(response);
        },
        error: function(xhr, status, error){
            console.error("Произошла ошибка: " + error);
        }
      });
}

function delayedSearch() {
    clearTimeout(searchTimeoutToken); 
    searchTimeoutToken = setTimeout(searchProjects, 300); 
}

function searchProjects() {
    var input, filter, projects, title, description, i, titleTxtValue, descriptionTxtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    projects = document.getElementsByClassName('project');

    for (i = 0; i < projects.length; i++) {
        title = projects[i].getElementsByClassName('project__title')[0];
        description = projects[i].getElementsByClassName('project__discryption')[0];
        titleTxtValue = title.textContent || title.innerText;
        descriptionTxtValue = description.textContent || description.innerText;

        if (titleTxtValue.toUpperCase().indexOf(filter) > -1 || descriptionTxtValue.toUpperCase().indexOf(filter) > -1) {
            projects[i].style.display = "";
        } else {
            projects[i].style.display = "none";
        }
    }
}


function refrashd(){
    var statuss = [
        ["Пройден","#00FF00"],
        ["Не пройден","#FF0000"]
        ["Невозможно пройти","#808080"],
        ["Пропущен","#FFA500"]]
    
    var n = Number(this.getAttribute("data-status"))
    console.log(n)
    this.title = statuss[n][0]
}

a = [...document.querySelectorAll(".project__status")].forEach(i => {
i.addEventListener("click",refrashd)
});


search.addEventListener("keyup",delayedSearch)
closer.addEventListener("click",closeModal)
add.addEventListener("click",openModal)
submit.addEventListener("click",setChekLists)
