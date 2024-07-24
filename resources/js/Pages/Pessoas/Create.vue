<template>
    <v-container>
        <v-form @submit.prevent="submit">
            <v-text-field label="Nome" v-model="form.nome" required />
            <v-text-field label="Nome Social" v-model="form.nome_social" />
            <v-text-field label="CPF" v-model="form.cpf" required />
            <v-text-field label="Nome do Pai" v-model="form.nome_pai" />
            <v-text-field label="Nome da Mãe" v-model="form.nome_mae" />
            <v-text-field label="Telefone" v-model="form.telefone" />
            <v-text-field label="Email" v-model="form.email" />

            <v-btn type="submit">Cadastrar</v-btn>
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
                nome: '',
                nome_social: '',
                cpf: '',
                nome_pai: '',
                nome_mae: '',
                telefone: '',
                email: '',
            },
        };
    },
    methods: {
        submit() {
            Inertia.post('/pessoas', this.form).then(() => {
                this.$router.push({ name: 'pessoas.index' });
            });
        },
    },
};
</script>
