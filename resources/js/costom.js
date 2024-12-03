import Inputmask from "inputmask";

Nova.booting((Vue, router, store) => {
    const applyMask = () => {
        const plateInput = document.querySelectorAll('input[name="plate"]'); // Campo "plate"
        if (plateInput) {
            Inputmask({
                mask: [
                    "AAA-9999", // Formato antigo
                    "AAA9A99"   // Formato Mercosul
                ],
                definitions: {
                    'A': {
                        validator: "[A-Za-z]",
                        casing: "upper" // Força letras maiúsculas
                    },
                    '9': {
                        validator: "[0-9]"
                    }
                },
                placeholder: "_",  // Preenche com underscore enquanto digita
                clearIncomplete: true // Não aceita valor incompleto
            }).mask(plateInput);
        }
    };

    applyMask();
    document.addEventListener("turbolinks:load", applyMask);
});
