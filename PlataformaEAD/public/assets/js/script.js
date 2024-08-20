document.addEventListener('DOMContentLoaded', function () {
    const tipoSelect = document.getElementById('tipo');
    const cpfGroup = document.getElementById('cpf-group');
    const nomeCursoGroup = document.getElementById('nome_curso-group');

    tipoSelect.addEventListener('change', function () {
        if (tipoSelect.value === 'docente') {
            cpfGroup.style.display = 'block';
            nomeCursoGroup.style.display = 'block';
        } else {
            cpfGroup.style.display = 'none';
            nomeCursoGroup.style.display = 'none';
        }
    });
});