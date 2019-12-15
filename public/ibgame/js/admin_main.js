function modalsControl(e){
    if (e.target.classList.contains('add_team_and_game')) {
        let form = qS('.team_add_form');
        showModal(form);
    }

    if (e.target.classList.contains('add_resource')) {
        let form = qS('.resource_add_form');
        showModal(form);
    }

    if (e.target.classList.contains('add_evidence')) {
        let form = qS('.evidence_add_form');
        showModal(form);
    }

    if (e.target.classList.contains('add_trigger')) {
        let form = qS('.trigger_add_form');
        showModal(form);
    }

    if (e.target.classList.contains('save_resource') ||
        e.target.classList.contains('save_evidence') ||
        e.target.classList.contains('save_trigger')
        ) {

        e.target.parentNode.childNodes[6].value = 'save';
    }
    if (e.target.classList.contains('send_resource') ||
        e.target.classList.contains('send_evidence') ||
        e.target.classList.contains('send_trigger')
        ) {
        e.target.parentNode.childNodes[6].value = 'send';
    }
}

function showModal(modal) {
    modal.classList.add('modal-active');
    overlay.classList.remove('hidden');
}

document.addEventListener('click', modalsControl);

function checkForm(form) {
    if (form.childNodes[2].innerText === 'Добавление команды') {
        let team_name = qS('input[name="name"]').value;
        let team_description = qS('textarea[name="description"]').value;
        if (team_name === '') alert('Необходимо добавить название команды');
        if (team_description === '') alert('Нобходимо добавить описание задачи');
        return !(team_name === '' || team_description === '');
    }

    if (form.childNodes[2].innerText === 'Добавление ресурса') {
        let resource_name = qS('input[name="resource"]').value;
        if (resource_name === '') alert('Необходимо добавить название ресурса');
        return !(resource_name === '');
    }

    if (form.childNodes[2].innerText === 'Добавление улики') {
        let resource_name = qS('input[name="resource"]').value;
        if (resource_name === '') alert('Необходимо добавить название улики');
        return !(resource_name === '');
    }

    if (form.childNodes[2].innerText === 'Добавление триггера') {
        let resource_name = qS('input[name="resource"]').value;
        if (resource_name === '') alert('Необходимо добавить название триггера');
        return !(resource_name === '');
    }
}


const admin_team = qS('.admin_item');

admin_team.addEventListener('click', selectTeam);
function selectTeam(e) {
    if (e.target.tagName === 'INPUT') {
        window.location = '/admin?team=' + e.target.value;
    }
}
