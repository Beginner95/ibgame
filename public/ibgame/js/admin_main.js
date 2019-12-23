function modalsControl(e){
    if (e.target.classList.contains('add_team_and_game')) {
        let form = qS('.team_add_form');
        showModal(form);
    }

    if (e.target.classList.contains('add_resource') || e.target.parentNode.classList.contains('resources_list')) {
        let form = qS('.resource_add_form');
        showModal(form);
        if (e.target.parentNode.classList.contains('resources_list')) {
            qS('textarea[name="resource-name"]').value = e.target.innerText;
            qS('input[name="resource-id"]').value = e.target.dataset.resourceId;

            let file = e.target.dataset.resourceFile;
            let file_resource = qS('.file-resource');
            if (file !== '') {
                let link_file = createElem('a');
                addClass(link_file, 'link-file-resource');
                link_file.href = '/file/evidence/' + file;
                link_file.append('Скачать файл');
                if (file_resource === null) {
                    qS('.link-file-resource').href = '/file/resource/' + file;
                } else {
                    file_resource.replaceWith(link_file);
                }
                addStyle(qS('.link-file-resource'), 'display:block');
            } else {
                if (qS('input[name="resource"]') !== null) {
                    addStyle(qS('input[name="evidence"]'), 'display:none');
                    if (file_resource !== null) {
                        addStyle(file_resource, 'display:none');
                    } else {
                        addStyle(qS('.link-file-resource'), 'display:none');
                    }
                }
            }

            if (e.target.dataset.existResource === '1') {
                addStyle(qS('.send_resource'), 'display:none');
            } else {
                addStyle(qS('.send_resource'), 'display:block');
            }

            let btn = qS('.save_resource');
            let remove_link = createElem('a');
            addClass(remove_link, 'btn btn-blue save_resource');
            addStyle(remove_link, 'float: left;');
            remove_link.href = '/admin/resource/destroy/' + e.target.dataset.resourceId + '';
            remove_link.append('Удалить');
            btn.replaceWith(remove_link);
        }
    }

    if (e.target.classList.contains('add_evidence') || e.target.parentNode.classList.contains('evidence_list')) {
        let form = qS('.evidence_add_form');
        showModal(form);
        if (e.target.parentNode.classList.contains('evidence_list')) {
            qS('textarea[name="evidence-name"]').value = e.target.innerText;
            qS('input[name="evidence-id"]').value = e.target.dataset.evidenceId;

            let file = e.target.dataset.evidenceFile;
            let file_evidence = qS('.file-evidence');
            if (file !== '') {
                let link_file = createElem('a');
                addClass(link_file, 'link-file-evidence');
                link_file.href = '/file/evidence/' + file;
                link_file.append('Скачать файл');
                if (file_evidence === null) {
                    qS('.link-file-evidence').href = '/file/evidence/' + file;
                } else {
                    file_evidence.replaceWith(link_file);
                }
                addStyle(qS('.link-file-evidence'), 'display:block');
            } else {
                if (qS('input[name="evidence"]') !== null) {
                    addStyle(qS('input[name="evidence"]'), 'display:none');
                    if (file_evidence !== null) {
                        addStyle(file_evidence, 'display:none');
                    } else {
                        addStyle(qS('.link-file-evidence'), 'display:none');
                    }
                }
            }

            if (e.target.dataset.existEvidence === '1') {
                addStyle(qS('.send_evidence'), 'display:none');
            } else {
                addStyle(qS('.send_evidence'), 'display:block');
            }

            let btn = qS('.save_evidence');
            let remove_link = createElem('a');
            addClass(remove_link, 'btn btn-blue save_evidence');
            addStyle(remove_link, 'float: left;');
            remove_link.href = '/admin/evidence/destroy/' + e.target.dataset.evidenceId + '';
            remove_link.append('Удалить');
            btn.replaceWith(remove_link);
        }
    }

    if (e.target.classList.contains('add_trigger') || e.target.parentNode.classList.contains('trigger_list')) {
        let form = qS('.trigger_add_form');
        showModal(form);
        if (e.target.parentNode.classList.contains('trigger_list')) {
            qS('textarea[name="trigger-name"]').value = e.target.innerText;
            qS('input[name="trigger-id"]').value = e.target.dataset.triggerId;

            let file = e.target.dataset.triggerFile;
            let file_trigger = qS('.file-trigger');
            if (file !== '') {
                let link_file = createElem('a');
                addClass(link_file, 'link-file-trigger');
                link_file.href = '/file/trigger/' + file;
                link_file.append('Скачать файл');
                addStyle(link_file, 'display:block');
                if (file_trigger === null) {
                    qS('.link-file-trigger').href = '/file/trigger/' + file;
                } else {
                    file_trigger.replaceWith(link_file);
                }
                addStyle(qS('.link-file-trigger'), 'display:block');
            } else {
                if (qS('input[name="trigger"]') !== null) {
                    addStyle(qS('input[name="trigger"]'), 'display:none');
                    if (file_trigger !== null) {
                        addStyle(file_trigger, 'display:none');
                    } else {
                        addStyle(qS('.link-file-trigger'), 'display:none');
                    }
                }
            }

            if (e.target.dataset.existTrigger === '1') {
                addStyle(qS('.send_trigger'), 'display:none');
            } else {
                addStyle(qS('.send_trigger'), 'display:block');
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

    if (e.target.classList.contains('add_site_map')) {
        let form = qS('.add_site_map_form');
        showModal(form);
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
        let resource_name = qS('textarea[name="resource-name"]').value;
        if (resource_name === '') alert('Необходимо добавить название ресурса');
        return !(resource_name === '');
    }

    if (form.childNodes[2].innerText === 'Добавление улики') {
        let resource_name = qS('textarea[name="evidence-name"]').value;
        if (resource_name === '') alert('Необходимо добавить название улики');
        return !(resource_name === '');
    }

    if (form.childNodes[2].innerText === 'Добавление триггера') {
        let trigger_name = qS('textarea[name="trigger-name"]').value;
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

function adminHandleFileSelect(evt) {
    let id = evt.target.parentNode.dataset.id;
    if (evt.target.classList.contains(id)) {
        addStyle(evt.target.parentNode.nextElementSibling, 'display:flex');
        var files = [];
        var file = evt.target.files; // FileList object
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = file[i]; i++) {
            // Only process image files.
            if (!f.type.match('image.*')) {
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var span = createElem('span');
                        span.classList.add('thumb_wrap');
                        span.innerHTML = ['<img class="thumb" title="', theFile.name, '" src="img/noimg.png" /> <button type="button" class="remove_file">&times;</button>'].join('');
                        evt.target.parentNode.nextElementSibling.insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            } else {
                var reader = new FileReader();
                // Closure to capture the file information.
                reader.onload = (function (theFile) {
                    return function (e) {
                        // Render thumbnail.
                        var span = createElem('span');
                        span.classList.add('thumb_wrap');
                        span.innerHTML = ['<img class="thumb" title="', theFile.name, '" src="', e.target.result, '" /> <button type="button" class="remove_file">&times;</button>'].join('');
                        evt.target.parentNode.nextElementSibling.insertBefore(span, null);
                    };
                })(f);
                // Read in the image file as a data URL.
                reader.readAsDataURL(f);
            }
        }
    }
}

document.addEventListener('change', adminHandleFileSelect, false);