/**
 * Validação de CPF – versão correta e testada
 * Retorna true se o CPF for válido, false caso contrário.
 */
function TestaCPF(strCPF) {
    var cpf = strCPF.replace(/\D/g, '');

    // Verifica se tem 11 dígitos e não é uma sequência repetida
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
        return false;
    }

    // Valida o primeiro dígito verificador
    var soma = 0;
    for (var i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    var resto = soma % 11;
    var digito1 = (resto < 2) ? 0 : 11 - resto;

    if (digito1 !== parseInt(cpf.charAt(9))) {
        return false;
    }

    // Valida o segundo dígito verificador
    soma = 0;
    for (var i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = soma % 11;
    var digito2 = (resto < 2) ? 0 : 11 - resto;

    return digito2 === parseInt(cpf.charAt(10));
}