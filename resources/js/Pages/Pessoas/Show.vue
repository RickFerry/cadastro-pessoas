<template>
    <v-container>
        <v-card>
            <v-card-title>{{ pessoa.nome }}</v-card-title>
            <v-card-subtitle>{{ pessoa.cpf }}</v-card-subtitle>
            <v-card-text>
                <p>Nome Social: {{ pessoa.nome_social }}</p>
                <p>Nome do Pai: {{ pessoa.nome_pai }}</p>
                <p>Nome da Mãe: {{ pessoa.nome_mae }}</p>
                <p>Telefone: {{ pessoa.telefone }}</p>
                <p>Email: {{ pessoa.email }}</p>
            </v-card-text>
            <v-btn @click="editarPessoa">Editar Pessoa</v-btn>
        </v-card>

        <v-card>
            <v-card-title>Endereços</v-card-title>
            <v-list>
                <v-list-item v-for="endereco in enderecos" :key="endereco.id">
                    <v-list-item-content>
                        <v-list-item-title>{{ endereco.tipo }}</v-list-item-title>
                        <v-list-item-subtitle>{{ endereco.logradouro }}, {{ endereco.numero }}, {{ endereco.bairro }}, {{ endereco.cidade }} - {{ endereco.estado }}</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-btn @click="editarEndereco(endereco.id)">Editar</v-btn>
                </v-list-item>
            </v-list>
            <v-btn @click="adicionarEndereco">Adicionar Endereço</v-btn>
        </v-card>
    </v-container>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    data() {
        return {
            pessoa: {},
            enderecos: [],
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            Inertia.get(`/api/pessoas/${this.$route.params.id}`).then(response => {
                this.pessoa = response.data.pessoa;
                this.enderecos = response.data.enderecos;
            });
        },
        editarPessoa() {
            this.$router.push({ name: 'pessoas.edit', params: { id: this.$route.params.id } });
        },
        adicionarEndereco() {
            this.$router.push({ name: 'enderecos.create', params: { id: this.$route.params.id } });
        },
        editarEndereco(enderecoId) {
            this.$router.push({ name: 'enderecos.edit', params: { id: enderecoId } });
        },
    },
};
</script>
