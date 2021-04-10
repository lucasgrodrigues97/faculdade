function toggleInput(cursoId) {
    const atualCurso = document.getElementById(`atual-curso-${cursoId}`);
    const atualizarCurso = document.getElementById(`atualizar-curso-${cursoId}`);

    if (atualizarCurso.hasAttribute('hidden')) {
        atualizarCurso.removeAttribute('hidden');
        atualCurso.hidden = true;
    } else {
        atualCurso.removeAttribute('hidden');
        atualizarCurso.hidden = true;
    }
}

function editarCurso(cursoId) {
    let formData = new FormData();
    const url = `/cursos/${cursoId}/editarNome`;
    //const nome = document.querySelector(`#atualizar-curso-${cursoId} > input`).value;
    const nome = document.getElementById('curso-nome').value;
    const _token = document.querySelector('input[name="_token"]').value;
    formData.append('nome', nome);
    formData.append('_token', _token);
    fetch(url, {
        body: formData,
        method: 'POST'
    }).then(() => {
        toggleInput(cursoId);
        document.getElementById(`atual-curso-${cursoId}`).textContent = nome;
    });
}
