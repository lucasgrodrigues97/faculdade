function toggleInput(alunoId) {
    const atualAluno = document.getElementById(`atual-aluno-${alunoId}`);
    const atualizarAluno = document.getElementById(`atualizar-aluno-${alunoId}`);

    if (atualizarAluno.hasAttribute('hidden')) {
        atualizarAluno.removeAttribute('hidden');
        atualAluno.hidden = true;
    } else {
        atualAluno.removeAttribute('hidden');
        atualizarAluno.hidden = true;
    }
}

function rotaAlunos() {
    window.location.href = '/alunos';
}

function editarAluno(alunoId) {
    let formData = new FormData();
    const url = `/alunos/${alunoId}/editarAluno`;
    //const nome = document.querySelector(`#atualizar-aluno-${alunoId} > input`).value;
    const nome = document.getElementById('aluno-nome').value;
    const curso = document.getElementById('aluno-curso').value;
    const turma = document.getElementById('aluno-turma').value;
    const foto = document.getElementById('aluno-foto');
    const endereco = document.getElementById('aluno-endereco').value;
    const _token = document.querySelector('input[name="_token"]').value;
    formData.append('nome', nome);
    formData.append('curso', curso);
    formData.append('turma', turma);
    formData.append('endereco', endereco);
    formData.append('foto', foto.files[0]);
    formData.append('_token', _token);
    fetch(url, {
        body: formData,
        method: 'POST'
    }).then(() => {
        rotaAlunos();
    });
}

