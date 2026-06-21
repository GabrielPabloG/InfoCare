/**
 * InfoCare – Validadores front‑end
 * Centraliza funções de validação e feedback visual.
 */

// CPF (algoritmo oficial)
function TestaCPF(strCPF) {
    var cpf = strCPF.replace(/\D/g, '');
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
    var soma = 0, resto;
    for (var i = 0; i < 9; i++) soma += parseInt(cpf.charAt(i)) * (10 - i);
    resto = soma % 11;
    var digito1 = (resto < 2) ? 0 : 11 - resto;
    if (digito1 !== parseInt(cpf.charAt(9))) return false;
    soma = 0;
    for (var i = 0; i < 10; i++) soma += parseInt(cpf.charAt(i)) * (11 - i);
    resto = soma % 11;
    var digito2 = (resto < 2) ? 0 : 11 - resto;
    return digito2 === parseInt(cpf.charAt(10));
}

// CEP (8 dígitos)
function validaCEP(cep) {
    var cepLimpo = cep.replace(/\D/g, '');
    return cepLimpo.length === 8;
}

// Data de nascimento (não pode ser futura)
function validaDataNascimento(dataStr) {
    if (!dataStr) return false;
    var hoje = new Date();
    hoje.setHours(0, 0, 0, 0);
    var nasc = new Date(dataStr + 'T00:00:00');
    return nasc < hoje;
}

// Telefone (mínimo 10 dígitos)
function validaTelefone(telefone) {
    var num = telefone.replace(/\D/g, '');
    return num.length >= 10;
}

// Modal de feedback (substitui o alert)
function abrirFeedback(titulo, mensagem, foco) {
    document.getElementById('feedbackTitle').textContent = titulo;
    document.getElementById('feedbackMsg').textContent = mensagem;
    document.getElementById('feedbackModal').classList.add('open');
    if (foco) document.getElementById(foco).focus();
}