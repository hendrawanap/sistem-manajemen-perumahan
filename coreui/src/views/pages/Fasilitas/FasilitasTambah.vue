<template>
    <CRow>
        <CCol>
            <CCard>
                <CCardHeader>
                    <div  v class="d-flex justify-content-between">
                        <h2>Tambah Fasilitas</h2>
                    </div>
                </CCardHeader>
                <CCardBody>
                    <CForm>                                     
                        <CInput label="Nama Fasilitas" type="text" id="FasilitasInput" v-model="fasilitas.namaFasilitas"/>
                        <CInput label="Kondisi" type="text" id="KondisiInput" v-model="fasilitas.kondisi"/>
                        <CInput label="Informasi" type="text" id="InformasiInput" v-model="fasilitas.informasi"/>
                        <CButton type="submit" color="primary" @click="submit()" >Submit</CButton>
                    </CForm>
                </CCardBody>
            </CCard>
            </CCol>
    </CRow>
</template>

<script>
import Axios from 'axios';
export default {
    name: "Tambah Fasilitas",
    data() {
        return {
            fasilitas: {
                namaFasilitas : "",
                kondisi : "",
                informasi : ""
            }
        }
    },
    methods: {
        addFasilitas(){
            const formData = new FormData();
            const fasilitas = this.fasilitas;
            formData.append("namaFasilitas", fasilitas.namaFasilitas);
            formData.append("kondisi", fasilitas.kondisi);
            formData.append("informasi", fasilitas.informasi);
            Axios.post(this.$apiAdress + '/api/pegawai/add').then( r => console.log('berhasil ditambahkan'))
        }
    }
}
</script>