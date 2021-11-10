<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div  v class="d-flex justify-content-between">
                        <h2>Edit Fasilitas</h2>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CForm v-on:submit.prevent>                                     
                        <CInput label="Nama Fasilitas" type="text" id="FasilitasInput" v-model="fasilitas.namaFasilitas"/>
                        <CSelect
                            label="Kondisi"
                            :options="kondisiOptions"
                            :value.sync="fasilitas.kondisi"
                            placeholder="Pilih Kondisi"
                        />
                        <CInput label="Informasi" type="text" id="InformasiInput" v-model="fasilitas.informasi"/>
                        <CButton type="submit" color="primary" @click="editFasilitas()" >Submit</CButton>
                    </CForm>
                </CCardBody>
            </CCard>
        </CCol>
    </CRow>
</template>

<script>
import axios from 'axios'
export default {
    name: "FasilitasEdit",
    title:'Edit Fasilitas',
    data() {
        return {
            fasilitas: {
                namaFasilitas : "",
                kondisi : "",
                informasi : ""
            },
            kondisiOptions: [
                "Baik",
                "Dalam Perbaikan",
                "Rusak"
            ]
        }
    },
    methods: {
        editFasilitas(){
            const formData = new FormData();
            const fasilitas = this.fasilitas;
            formData.append("namaFasilitas", fasilitas.namaFasilitas);
            formData.append("kondisi", fasilitas.kondisi);
            formData.append("informasi", fasilitas.informasi);

            axios.post(this.$apiAdress + '/api/fasilitas/edit/' + this.$route.params.id  + '?token=' + localStorage.getItem('api_token'), formData).then( r => console.log('berhasil diubah'))
        },

        getFasilitas(){
            axios.get(this.$apiAdress + '/api/fasilitas/' + this.$route.params.id + '?token=' + localStorage.getItem('api_token')).then( r => {
                const data = r.data[0];
                this.fasilitas = {
                    namaFasilitas: data.namaFasilitas,
                    kondisi: data.kondisi,
                    informasi: data.informasi
                }
            });
        }
    },
    mounted(){
        this.getFasilitas();
    }
}
</script>