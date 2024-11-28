Nova.booting((Vue, router, store) => {
    // Ajusta o tempo de exibição dos toasts (em milissegundos)
    Vue.component('toast', {
        extends: Vue.options.components['toast'],
        methods: {
            show(message) {
                this.message = message;
                this.visible = true;

                // Altere o tempo de exibição conforme necessário
                setTimeout(() => {
                    this.visible = false;
                }, 10000); // 10 segundos
            }
        }
    });
});

require('./telefone-mask');
