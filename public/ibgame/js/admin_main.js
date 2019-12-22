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

    if (e.target.classList.contains('add_trigger') || e.target.parentNode.classList.contains('trigger_list')) {
        let form = qS('.trigger_add_form');
        showModal(form);
        if (e.target.parentNode.classList.contains('trigger_list')) {
            qS('input[name="trigger-name"]').value = e.target.innerText;
            qS('input[name="trigger-id"]').value = e.target.dataset.triggerId;

            let file = e.target.dataset.triggerFile;

            if (file !== '') {
                let link_file = createElem('a');
                link_file.href = '/file/trigger/' + file;
                link_file.append('Скачать файл');
                qS('input[name="trigger"]').replaceWith(link_file);
                link_file.parentNode.childNodes[3].remove();
            } else {
                qS('input[name="trigger"]').parentNode.remove();
            }

            if (e.target.dataset.existTrigger === '1') {
                qS('.send_trigger').remove();
            }

            let btn = qS('.save_trigger');
            let remove_link = createElem('a');
            addClass(remove_link, 'btn btn-blue save_trigger');
            addStyle(remove_link, 'float: left;');
            remove_link.href = '/admin/trigger/destroy/' + e.target.dataset.triggerId + '';
            remove_link.append('Удалить');
            btn.replaceWith(remove_link);
        }
    }

    if (e.target.classList.contains('add_event_option') || e.target.classList.contains('variant_edit')) {
        let form = qS('.event_option_add_form');
        showModal(form);
        if (e.target.classList.contains('variant_edit')) {
            qS('input[name="name-event-option"]').value = e.target.parentNode.childNodes[1].innerText;
            qS('textarea[name="description-event-option"]').value = e.target.parentNode.childNodes[7].innerText;
            qS('input[name="event-option-id"]').value = e.target.id;
        }
    }

    if (e.target.classList.contains('save_resource') ||
        e.target.classList.contains('save_evidence') ||
        e.target.classList.contains('save_trigger') ||
        e.target.classList.contains('save_event_option')
        ) {

        e.target.parentNode.childNodes[6].value = 'save';
    }
    if (e.target.classList.contains('send_resource') ||
        e.target.classList.contains('send_evidence') ||
        e.target.classList.contains('send_trigger') ||
        e.target.classList.contains('send_event_option')
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
        let trigger_name = qS('input[name="trigger"]').value;
        if (trigger_name === '') alert('Необходимо добавить название триггера');
        return !(trigger_name === '');
    }

    if (form.childNodes[2].innerText === 'Добавление варианта развития события') {
        let name = qS('input[name="name-event-option"]').value;
        let description = qS('textarea[name="description-event-option"]').value;
        if (name === '') alert('Необходимо добавить вариант события');
        if (description === '') alert('Необходимо добавить название события');
        return !(description === '' || name === '');
    }
}


const admin_team = qS('.admin_item');

admin_team.addEventListener('click', selectTeam);
function selectTeam(e) {
    if (e.target.tagName === 'INPUT') {
        window.location = '/admin?team=' + e.target.value;
    }
}

function createElem(el) {
    return document.createElement(el);
}

function addStyle(el, stl) {
    return el.style = stl
}

function addClass(el, cls) {
    return el.className = cls
}