function modalsControl(e){
    if (e.target.classList.contains('add_team')) {
        let form = qS('.team_add_form');
        form.classList.add('modal-active');
        overlay.classList.remove('hidden');
    }

    // if (e.target.classList.contains('team_modal_close')) {
    //     c(!checkForm(e.target.parentNode));
    //     let modal = getEBCN('modal-active')[0];
    //     modal.classList.remove('modal-active');
    //     overlay.classList.add('hidden')
    // }
}

document.addEventListener('click', modalsControl);

function checkForm(form) {
    let team_name = qS('input[name="name"]').value;
    let team_description = qS('textarea[name="description"]').value;

    if (team_name === '') alert('Необходимо добавить название команды');
    if (team_description === '') alert('Нобходимо добавить описание задачи');
    return !(team_name === '' || team_description === '');
}


const admin_team = qS('.admin_item');

admin_team.addEventListener('click', selectTeam);
function selectTeam(e) {
    if (e.target.tagName === 'INPUT') {
        window.location = '/admin?team=' + e.target.value;
    }
}
