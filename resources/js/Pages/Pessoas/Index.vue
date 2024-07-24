<template>
    <v-container>
        <v-text-field label="Pesquisar por CPF" v-model="cpf" />
        <v-btn @click="search">Pesquisar</v-btn>

        <v-list>
            <v-list-item v-for="pessoa in pessoas" :key="pessoa.id" @click="viewPessoa(pessoa.id)">
                <v-list-item-content>
                    <v-list-item-title>{{ pessoa.nome }}</v-list-item-title>
                    <v-list-item-subtitle>{{ pessoa.cpf }}</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-container>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    data() {
        return {
            cpf: '',
            pessoas: [],
        };
    },
    methods: {
        search() {
            Inertia.get('/api/pessoas', { cpf: this.cpf }).then(response => {
                this.pessoas = response.data;
            });
        },
        viewPessoa(id) {
            Inertia.visit(`/pessoas/${id}`);
        },
    },
};
</script>
