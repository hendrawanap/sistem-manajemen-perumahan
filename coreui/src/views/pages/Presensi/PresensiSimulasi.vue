<template>
    <CRow>
        <CCol>
            <CAlert :show.sync="showAlert" :color="alertColor" closeButton>
                {{ message }}
                <CButton
                    class="position-absolute"
                    color="secondary"
                    style="right:10px;top: 50%;transform: translateY(-50%);"
                    @click="showAlert = false"
                >
                    Close
                </CButton>
            </CAlert>
            <CCard>
                <CCardBody class="position-relative">
                    <CInput label="Nama Pegawai" type="text" v-model="searchQuery" @focus="onFocus" @blur="onBlur"/>
                    <CCard class="dropdown-list shadow-sm" v-show="focused">
                        <CListGroup flush>
                            <CListGroupItem class="dropdown-item" v-for="pegawai in resultQuery" :key="'pegawai-'+pegawai.id" @click="setSelectedPegawai(pegawai)">
                                {{ pegawai.nama }}
                            </CListGroupItem>
                        </CListGroup>
                    </CCard>
                    <CInput label="Waktu Presensi" type="datetime-local" v-model="waktuPresensi"/>
                    <CButton color="primary" @click="presence">Presensi</CButton>
                </CCardBody>
            </CCard>
        </CCol>
    </CRow>
</template>

<script>
import axios from 'axios'
import Dropdown from 'vue-simple-search-dropdown';

export default {
    title: 'Simulasi Presensi',
    name: 'PresensiSimulasi',
    components: {
        Dropdown,
    },
    data() {
        return {
            daftarPegawai: [],
            searchQuery: null,
            selectedPegawai: null,
            focused: false,
            waktuPresensi: null,
            showAlert: false,
            message: "",
            alertColor: "success",
        }
    },
    methods: {
        fetchDaftarPegawai() {
            axios.get(this.$apiAdress + '/api/pegawai?token=' + localStorage.getItem('api_token')).then(r =>{
                this.daftarPegawai = r.data
            })
        },
        setSelectedPegawai(pegawai) {
            this.selectedPegawai = pegawai;
            this.searchQuery = pegawai.nama;
        },
        onFocus() {
            this.focused = true
        },
        onBlur() {
            setTimeout(() => {
                this.focused = false
            },100)
        },
        presence() {
            const formData = new FormData();
            formData.append('idPegawai', this.selectedPegawai.id);
            formData.append('waktuPresensi', this.waktuPresensi);
            axios.post(this.$apiAdress + '/api/presensi?token=' + localStorage.getItem('api_token'), formData).then(r => {
                if (r.data.message == "Berhasil mencatat presensi") {
                    this.alertColor = "success"
                } else {
                    this.alertColor = "danger"
                }
                this.message = r.data.message;
                this.showAlert = true;
            });
        }
    },
    computed: {
        resultQuery() {
            if (this.searchQuery) {
                return this.daftarPegawai.filter(item => {
                    return this.searchQuery
                        .toLowerCase()
                        .split(" ")
                        .every(v => item.nama.toLowerCase().includes(v));
                });
            } else {
                return this.daftarPegawai;
            }
        },
    },
    mounted() {
        this.fetchDaftarPegawai();
    }
}
</script>

<style scoped>
    .dropdown-list {
        position: absolute;
        top: 95px;
        max-height: 200px;
        overflow: auto;
        left: 20px;
        right: 20px;
    }
    .dropdown-item:hover {
        color: white;
        background-color: rgb(82, 82, 94);
        cursor: pointer;
    }
</style>