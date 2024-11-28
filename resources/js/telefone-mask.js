document.addEventListener('DOMContentLoaded', () => {
    const telefoneInput = document.querySelector('input[name="contact"]');

    if (telefoneInput) {
        telefoneInput.addEventListener('input', () => {
            const valor = telefoneInput.value;
            const mascara = '99 99999-9999 ou 99 9999-9999';
            const regex = /^(\d{2})\s(\d{5})-(\d{4})|(\d{2})\s(\d{4})-(\d{4})$/;

            if (!regex.test(valor)) {
                telefoneInput.value = valor.replace(/[^0-9]/g, '').replace(/(\d{2})(\d{5})(\d{4})/, '$1 $2-$3').replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2-$3');
            }
        });
    }
});
