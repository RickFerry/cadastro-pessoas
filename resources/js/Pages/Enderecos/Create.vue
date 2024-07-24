<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-select label="Tipo de Endereço" v-model="form.tipo" :items="['Residencial', 'Comercial']" required />
            <v-text-field label="CEP" v-model="form.cep" @change="buscarEndereco" required />
            <v-text-field label="Logradouro" v-model="form.logradouro" :disabled="enderecoBloqueado" required />
            <v-text-field label="Número" v-model="form.numero" required />
            <v-text-field label="Complemento" v-model="form.complemento" />
            <v-text-field label="Bairro" v-model="form.bairro" :disabled="enderecoBloqueado" required />
            <v-text-field label="Estado" v-model="form.estado" :disabled="enderecoBloqueado" required />
            <v-text-field label="Cidade" v-model="form.cidade" :disabled="enderecoBloqueado" required />
            <v-btn type="submit">Cadastrar Endereço</v-btn>
        </v-form>
    </v-container>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    data() {
        return {
            form: {
                tipo: '',
                cep: '',
                logradouro: '',
                numero: '',
                complemento: '',
                bairro: '',
                estado: '',
                cidade: '',
            },
            enderecoBloqueado: false,
        };
    },
    methods: {
        buscarEndereco() {
            // Substitua esta URL pela URL da API de CEP que você escolher
            const url = `https://viacep.com.br/ws/${this.form.cep}/json/`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado.');
                        return;
                    }
                    this.form.logradouro = data.logradouro;
                    this.form.bairro = data.bairro;
                    this.form.estado = data.uf;
                    this.form.cidade = data.localidade;
                    this.enderecoBloqueado = true;
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                });
        },
        submit() {
            Inertia.post(`/pessoas/${this.$route.params.id}/enderecos`, this.form).then(() => {
                this.$router.push({ name: 'pessoas.show', params: { id: this.$route.params.id } });
            });
        },
    },
};
</script>
